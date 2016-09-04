package com.example.courierdeliverysystem;

import java.util.Locale;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.location.Geocoder;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.ListView;
import android.os.Build;

public class DelProductInfo extends ActionBarActivity implements OnClickListener{
	int px,py;
	String id;
	boolean IstabTouched=false;
	ListView list;
	int ProductCount;
	String info;
	String delInfo[];
	static public boolean Isconnecting;
	ConnectThread connectThread;
	static String[] deleveryArray=null; 
	public ArrayAdapter<String> deleveryAdapter; 

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_del_product_info);
		
		findViewById(R.id.mapviewbtn).setOnClickListener(this);
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		list = (ListView)findViewById(R.id.todeleverlist);
		
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=4;
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
		
		ProductCount = Integer.parseInt(delInfo[delInfo.length-1]);
		deleveryArray = new String[ProductCount];
		for(int i=0;i<ProductCount;i++){
			String divString[];
			divString = delInfo[i].split(":");
			deleveryArray[i]="주소: "+divString[0]+"\n전화번호: "+divString[1]+"\t성명: "+divString[2];
			//deleveryArray[i]=divString[0]+"\t\t"+divString[1]+"\t\t"+divString[2];
		}
		deleveryAdapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,deleveryArray);		
		list.setAdapter(deleveryAdapter);
		list.setChoiceMode(ListView.CHOICE_MODE_SINGLE);  
	}
	@Override
	public void onClick(View v) {
		Intent intent = new Intent(this, MapViewActivity.class);
		intent.putExtra("id", id);
		startActivity(intent);
		overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
		finish();
	}
	

	@Override
	 public boolean onTouchEvent(MotionEvent event){
			
		px =(int)event.getX();
		py =(int)event.getY();
		
		if(px<345 && py<250 && !IstabTouched){
			IstabTouched =true;
			Intent intent = new Intent(this, DelManInfo.class);
			intent.putExtra("id", id);
			startActivity(intent);
			overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
			finish();
		}
		 return super.onTouchEvent(event);		 
	 }
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.del_product_info, menu);
		return true;
	}
	

	

}
