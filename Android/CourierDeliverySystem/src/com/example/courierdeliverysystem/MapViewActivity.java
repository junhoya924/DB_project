package com.example.courierdeliverysystem;

import java.io.IOException;
import java.util.List;
import java.util.Locale;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Rect;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.KeyEvent;
import android.view.MotionEvent;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Toast;

import com.nhn.android.maps.NMapActivity;
import com.nhn.android.maps.NMapCompassManager;
import com.nhn.android.maps.NMapController;
import com.nhn.android.maps.NMapLocationManager;
import com.nhn.android.maps.NMapOverlay;
import com.nhn.android.maps.NMapOverlayItem;
import com.nhn.android.maps.NMapView;
import com.nhn.android.maps.NMapView.OnMapStateChangeListener;
import com.nhn.android.maps.NMapView.OnMapViewTouchEventListener;
import com.nhn.android.maps.maplib.NGeoPoint;
import com.nhn.android.maps.nmapmodel.NMapError;
import com.nhn.android.maps.overlay.NMapPOIdata;
import com.nhn.android.maps.overlay.NMapPOIitem;
import com.nhn.android.mapviewer.overlay.NMapCalloutOverlay;
import com.nhn.android.mapviewer.overlay.NMapCalloutOverlay.OnClickListener;
import com.nhn.android.mapviewer.overlay.NMapMyLocationOverlay;
import com.nhn.android.mapviewer.overlay.NMapOverlayManager;
import com.nhn.android.mapviewer.overlay.NMapOverlayManager.CalloutOverlayViewInterface;
import com.nhn.android.mapviewer.overlay.NMapOverlayManager.OnOverlappedItemsListener;
import com.nhn.android.mapviewer.overlay.NMapOverlayManager.OnCalloutOverlayListener;
import com.nhn.android.mapviewer.overlay.NMapPOIdataOverlay;

import android.location.Address;


public class MapViewActivity extends NMapActivity implements OnMapStateChangeListener,OnMapViewTouchEventListener,OnCalloutOverlayListener {
	
		
	LocationThread locationThread;
	int mZoomLevel;
	String info;
	String id;
	String delInfo[];
	NMapView mMapView;
	NMapController mMapController;
	public static final String API_KEY = "8ccf615c053b9f23b8e1f3e77862f131";
	static public boolean Isconnecting;
	Geocoder gc;
	ConnectThread connectThread;
	NMapViewerResourceProvider mMapViewerResourceProvider =null;
	NMapOverlayManager mOverlayManager;	
	NMapLocationManager mMapLocationManager;
	NGeoPoint FucusLocation;
	NMapMyLocationOverlay mMyLocationOverlay;
	NMapCompassManager  mMapCompassManager;
	NMapPOIdata poiData;
	double temp_lat;
	double temp_long;
	String id_List[];
	//c1b406b32dbbbbeee5f2a36ddc14067f
	
	@Override
	public void onCreate(Bundle savedInstanceState){
	//setTheme(android.R.style.Theme_NoTitleBar_Fullscreen);
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
	
		setContentView(R.layout.activity_mapview);
		Intent intend=getIntent();
		id=intend.getExtras().getString("id");	
	
		// create map view
		mMapView = new NMapView(this);
	
		// set a registered API key for Open MapViewer Library
		mMapView.setApiKey(API_KEY);
		// set the activity content to the map view
		setContentView(mMapView);
		// initialize map view
		mMapView.setClickable(true);
		// register listener for map state changes
		mMapView.setOnMapStateChangeListener(this);
		mMapView.setOnMapViewTouchEventListener(this);
		mMapView.setBuiltInZoomControls(true, null);	
		
		// use map controller to zoom in/out, pan and set map center, zoom level etc.
		mMapController = mMapView.getMapController();		
		/*Overlay*/
		mMapViewerResourceProvider = new NMapViewerResourceProvider(this);
		mOverlayManager = new NMapOverlayManager(this, mMapView,mMapViewerResourceProvider);	
		//오버레이에 표시하기 위한 마커 이미지의 id값 생성
		
		int markedId = NMapPOIflagType.PIN;
		
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=5;
		Isconnecting = true;
		connectThread.start();
		try {
			Thread.sleep(100);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		while(Isconnecting);
		info =connectThread.info;
		delInfo = info.split(";");
		gc = new Geocoder(this,Locale.KOREAN);
		int ProductCount = Integer.parseInt(delInfo[delInfo.length-1]);
		//deleveryArray = new String[ProductCount];
		poiData = new NMapPOIdata(ProductCount, mMapViewerResourceProvider);
		poiData.beginPOIdata(ProductCount);
		for(int i=0;i<ProductCount;i++){
			String divString[];
			divString = delInfo[i].split(":");
			searchLocation(divString[0]);
			poiData.addPOIitem(temp_long,temp_lat,divString[0]+"\n전화번호"+divString[1]+"\n이름"+divString[2]+"\n물품번호:"+divString[3],NMapPOIflagType.PIN,0);
			//deleveryArray[i]=divString[0]+"\t\t"+divString[1]+"\t\t"+divString[2];
		}
		poiData.endPOIdata();

		NMapPOIdataOverlay poiDataOverlay = mOverlayManager.createPOIdataOverlay(poiData, null);

		poiDataOverlay.showAllPOIdata(0);
		
		//mOverlayManager.setOnCalloutOverlayViewListener(arg0);
		mOverlayManager.setOnCalloutOverlayListener(this);  //setOnCalloutOverlayListener(this);
		
		mMapLocationManager = new NMapLocationManager(this);
		mMapLocationManager.setOnLocationChangeListener(onMyLocationChangeListener);

		// compass manager
		mMapCompassManager = new NMapCompassManager(this);

		// create my location overlay
		mMyLocationOverlay = mOverlayManager.createMyLocationOverlay(mMapLocationManager, mMapCompassManager); 
		mZoomLevel = 5;

	}
	
	public void onLocationChanged(Location location){
		
	}
	
	
	@Override
	public NMapCalloutOverlay onCreateCalloutOverlay(final NMapOverlay arg0, final NMapOverlayItem arg1, final Rect arg2){
		
		//Toast.makeText(this, arg1.getTitle(), Toast.LENGTH_SHORT).show();
		
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("배송 정보");
        builder.setMessage(arg1.getTitle());
        builder.setNeutralButton("배송 완료", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
            	
            	int temp = poiData.count();
            	for(int i=0; i<temp; i++){
            		String temp1 = poiData.getPOIitem(i).getTitle();
            		String temp2 =  arg1.getTitle();
            		if(temp1==temp2)
            		{
            			//poiData.getPOIitem(i).setMarkerId(NMapPOIflagType.PIN);
            			String idVal[] = temp1.split(":");
            			poiData.getPOIitem(i).setKeepSelected(false);
            			poiData.getPOIitem(i).setVisibility(1);
            			
            			connectThread = new ConnectThread(idVal[1]);	
            			connectThread.ThreadType=10;
            			connectThread.start();        			
            			mMapController.animateTo(FucusLocation);
            			break;
            		}
	            	//
            	}
            }
        });
        builder.setNegativeButton("부재중", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

            }
        });
        builder.show();

		return null;
	}

	@Override
	public void onLongPress(NMapView arg0, MotionEvent arg1) {

		
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onLongPressCanceled(NMapView arg0) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onScroll(NMapView arg0, MotionEvent arg1, MotionEvent arg2) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onSingleTapUp(NMapView arg0, MotionEvent arg1) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onTouchDown(NMapView arg0, MotionEvent arg1) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onTouchUp(NMapView arg0, MotionEvent arg1) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onAnimationStateChange(NMapView arg0, int arg1, int arg2) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onMapCenterChange(NMapView arg0, NGeoPoint arg1) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void onZoomLevelChange(NMapView arg0, int arg1) {
		mZoomLevel = arg1;
		
		// TODO Auto-generated method stub
	}
	@Override
	public void onMapInitHandler(NMapView mapView, NMapError errorInfo) {
        if (errorInfo == null) { // success
        	startMyLocation();
        	//locationThread = new LocationThread();
    		//locationThread.start();
               //mMapController.setMapCenter(new NGeoPoint(latPoint, lngPoint), 11);
        } else { // fail
                Log.e("Nmap", "onMapInitHandler: error=" + errorInfo.toString());
        }

	}
	

	@Override
	public void onMapCenterChangeFine(NMapView arg0) {
		// TODO Auto-generated method stub
		
	}
	
	private void stopMyLocation() {
		if (mMyLocationOverlay != null) {
			mMapLocationManager.disableMyLocation();

			if (mMapView.isAutoRotateEnabled()) {
				mMyLocationOverlay.setCompassHeadingVisible(false);

				mMapCompassManager.disableCompass();

				mMapView.setAutoRotateEnabled(false, false);

				//mMapContainerView.requestLayout();
			}
		}
	}
	
	private final NMapLocationManager.OnLocationChangeListener onMyLocationChangeListener = new NMapLocationManager.OnLocationChangeListener() {

		@Override
		public boolean onLocationChanged(NMapLocationManager locationManager, NGeoPoint myLocation) {

			if (mMapController != null) {
				mMapController.animateTo(myLocation);
				FucusLocation =myLocation;
				//mMapController.setMapCenter(mMyLocationOverlay.getZPosition(),mZoomLevel);;			
				//mMapController.				
			}
			return true;
		}

		@Override
		public void onLocationUpdateTimeout(NMapLocationManager locationManager) {
			Toast.makeText(MapViewActivity.this, "Your current location is temporarily unavailable.", Toast.LENGTH_LONG).show();
		}

		@Override
		public void onLocationUnavailableArea(NMapLocationManager locationManager, NGeoPoint myLocation) {

			Toast.makeText(MapViewActivity.this, "Your current location is unavailable area.", Toast.LENGTH_LONG).show();

			stopMyLocation();
		}			
	};
	
	private void startMyLocation() {//내 위치 찾아서 이동. 각 부분은 정확히 파악이 안됨.

		if (mMyLocationOverlay != null) {
			if (!mOverlayManager.hasOverlay(mMyLocationOverlay)) {
				mOverlayManager.addOverlay(mMyLocationOverlay);
			}

			if (mMapLocationManager.isMyLocationEnabled()) {

				if (!mMapView.isAutoRotateEnabled()) {
					mMyLocationOverlay.setCompassHeadingVisible(true);

					mMapCompassManager.enableCompass();
					//mMapLocationManager.setUpdateFrequency(1000, (float) 0.2);

					mMapView.setAutoRotateEnabled(true, false);
					mMapController.setMapCenter(mMyLocationOverlay.getZPosition(),mZoomLevel);
					

					//mMapContainerView.requestLayout();
				} else {
					stopMyLocation();
				}

				mMapView.postInvalidate();
			} else {
				boolean isMyLocationEnabled = mMapLocationManager.enableMyLocation(true);
				if (!isMyLocationEnabled) {
					Toast.makeText(MapViewActivity.this, "Please enable a My Location source in system settings",
						Toast.LENGTH_LONG).show();

					Intent goToSettings = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
					startActivity(goToSettings);

					return;
				}
			}
		}
	}
	
	public class LocationThread extends Thread{
    	public LocationThread()
    	{
    	}
    			
    	public void run()
    	{
			//mMapController.animateTo(mMyLocationOverlay.getZPosition());
    		while(true){
    			try{ 	
    			//	mMapLocationManager.setUpdateFrequency(arg0, arg1);  				
    				mMapController.animateTo(mMapLocationManager.getMyLocation());
    			//mMapController.setMapCenter(mMyLocationOverlay.getZPosition(),mMapController.getZoomLevel());
    			sleep(1000);
    			}catch(Exception e){
    				e.printStackTrace();
    			}

    		}
    	}
    }
	private void searchLocation(String searchStr){
		//변환된 정보를 저장할 변수
		List<Address> addressList = null;
		try{
		//첫번째 매개변수는 주소이고 두번째 매개변수는 결과의 최대 개수.
		//두번째 매개변수는 경도
		//세번째는 결가의 최대 개수.
		addressList = gc.getFromLocationName(searchStr, 1);				
		if(addressList != null){
			for(int i=0; i<addressList.size(); i++){
				Address address = addressList.get(i);
				temp_lat=address.getLatitude();
				temp_long=address.getLongitude();
				//contentsText.append("\n 주소 :" + address.getAddressLine(0));
				//contentsText.append("\n 위도: " + address.getLatitude());
				//contentsText.append("\n 경도: " + address.getLongitude());
				}
			}		
		}
	catch(Exception e){
		e.printStackTrace();
	}		
	}
	
	public boolean onKeyDown(int keyCode, KeyEvent event){
		if(keyCode==KeyEvent.KEYCODE_BACK){		
			Intent intent = new Intent(this, DelProductInfo.class);
			intent.putExtra("id", id);
			startActivity(intent);
			overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
			finish();
		}
		return super.onKeyDown(keyCode, event);
	}

}
