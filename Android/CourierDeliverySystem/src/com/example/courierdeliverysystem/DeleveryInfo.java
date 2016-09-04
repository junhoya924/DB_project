package com.example.courierdeliverysystem;

import com.example.courierdeliverysystem.R.id;
import android.widget.Button;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.support.v4.widget.PopupMenuCompat;
import android.annotation.SuppressLint;
import android.app.ActionBar.LayoutParams;
import android.content.Intent;
import android.os.Bundle;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.os.Build;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.LinearLayout;
import android.widget.PopupMenu;
import android.widget.PopupWindow;
import android.widget.RelativeLayout;
import android.widget.ScrollView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

public class DeleveryInfo extends ActionBarActivity {

	String id;
	int px,py;
	boolean IstabTouched;
	ConnectThread connectThread;
	static public boolean Isconnecting;
	String info;
	String delInfo[];
	ListView list;
	FrameLayout frame;
	View popupview;
	String Review="";
	String Product_id="";
	PopupWindow mPopupWindow;
	static String[] deleveryArray =null;
	public ArrayAdapter<String> deleveryAdapter; 
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_delevery_info);
		
		frame = (FrameLayout)findViewById(R.id.container);
		popupview = View.inflate(this, R.layout.popup, null);
		mPopupWindow = new PopupWindow(popupview,650,300,true);//670
		mPopupWindow.setAnimationStyle(-1); // 애니메이션 설정(-1:설정안함, 0:설정)
		//final TextView Review_T =(TextView)popupview.findViewById(R.id.Review);
        final Button btnshow = (Button)popupview.findViewById(R.id.btnclose);
        final EditText Review_T =(EditText)popupview.findViewById(R.id.Review_Edit);
        btnshow.setOnClickListener(new Button.OnClickListener() {
               public void onClick(View v) {   	 
            	   Review = Review_T.getText().toString();
            	   if(!Review.equals("")){
            		   connectThread = new ConnectThread(Product_id);	
            		   connectThread.review=Review;
           				connectThread.ThreadType=66;
           				connectThread.start();
           				Review_T.setText("");
            	   }
            	   mPopupWindow.dismiss();
            	   //택배 보내면 됨 
            	   
               }
        });

			
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=6;
		Isconnecting = true;
		connectThread.start();
		//linear = (LinearLayout)findViewById(R.id.linear);

		try {
			Thread.sleep(100);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		while(Isconnecting);
		info =connectThread.info;
		delInfo = info.split(";");
		
		int ProductCount = Integer.parseInt(delInfo[delInfo.length-1]);
		deleveryArray = new String[ProductCount];
		for(int i=0;i<ProductCount;i++){
			String divString[];
			divString = delInfo[i].split(":");
			deleveryArray[i]="날짜: "+divString[0]+"\t물품정보: "+divString[1]+"\n수신/발신인: "+divString[2]+"\t\t배송정보: "+divString[3];
			//deleveryArray[i]=divString[0]+"\t\t"+divString[1]+"\t\t"+divString[2]+"\t\t"+divString[3];
		}	
		list = (ListView)findViewById(R.id.DeleveryItems);	
		deleveryAdapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,deleveryArray);	
		list.setAdapter(deleveryAdapter);
		list.setChoiceMode(ListView.CHOICE_MODE_SINGLE);
		list.setOnItemClickListener(new OnItemClickListener() {
			@SuppressLint("NewApi") @Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				//mPopupWindow.showAtLocation(frame,Gravity.CENTER,0,0);
				//list.getSt
				String selected;
				Review_T.setText("");
				selected=deleveryAdapter.getItem(position);		
				String temptemp[];
				temptemp = selected.split(":");
				String temp2[]=temptemp[4].split("_");
				
				if(temp2[0].equals(" 배송완료")){
					mPopupWindow.showAtLocation(frame,Gravity.CENTER,0,0);
					String prodId[];
					prodId = selected.split("_");		
					Product_id =prodId[1];
				}
			}
		});	
		IstabTouched = false;
	}
	@Override
	 public boolean onTouchEvent(MotionEvent event){
			
		px =(int)event.getX();
		py =(int)event.getY();
		
		if(px<250 && py<250 && !IstabTouched){
			
			IstabTouched =true;
			Intent intent = new Intent(this, CurrentInfo.class);
			intent.putExtra("id", id);
			startActivity(intent);
			overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
			finish();		
		}
		else if(px>500 && py<250 && !IstabTouched){
			IstabTouched =true;
			Intent intent = new Intent(this, PersonalInfo.class);
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
		getMenuInflater().inflate(R.menu.delevery_info, menu);
		return true;
	}
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		if (id == R.id.action_settings) {
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

}
