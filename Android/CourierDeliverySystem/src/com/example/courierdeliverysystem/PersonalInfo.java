package com.example.courierdeliverysystem;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.TextView;
import android.os.Build;

public class PersonalInfo extends ActionBarActivity {
	
	String id;
	int px,py;
	boolean IstabTouched;
	OnSwipeTouchListener temp;
	ConnectThread connectThread;
	public static boolean Isconnecting;
	String info="";
	String infodiv[];
	String id_Num="°í°´¹øÈ£: ";
	String name="ÀÌ¸§: ";
	String Phone="ÈÞ´ëÈ¥: ";
	String Addr="ÁÖ¼Ò: ";
	String delevered_Num="ÀÌ¿ë È½¼ö: ";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		IstabTouched = false;

		//setTheme(android.R.style.Theme_NoTitleBar_Fullscreen);
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_personal_info);
	
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=1;
		Isconnecting = true;
		connectThread.start();
		try {
			Thread.sleep(100);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		while(Isconnecting);
		info=connectThread.info;
		Log.d("CLient_info",info);
		infodiv = info.split(":");
		
		 id_Num+=infodiv[0];
		 name+=infodiv[1];
		 Phone+=infodiv[2];
		 Addr+=infodiv[3];
		 delevered_Num +=infodiv[4];
		 
		((TextView)findViewById(R.id.t_client_Num)).setText(id_Num);
		((TextView)findViewById(R.id.t_clientName)).setText(name);
		((TextView)findViewById(R.id.t_clientPhone)).setText(Phone);
		((TextView)findViewById(R.id.t_clientAddr)).setText(Addr);
		((TextView)findViewById(R.id.t_clientUsage)).setText(delevered_Num);
		
	}
	
	public void setSceen(){
		Intent intent = new Intent(this, CurrentInfo.class);
		startActivity(intent);
		overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
		finish();	
		
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
		else if(px>250 &&px<500 && py<250 && !IstabTouched){
			IstabTouched =true;
			Intent intent = new Intent(this, DeleveryInfo.class);
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
		getMenuInflater().inflate(R.menu.personal_info, menu);
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
