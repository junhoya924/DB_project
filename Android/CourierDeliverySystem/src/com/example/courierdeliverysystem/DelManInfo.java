package com.example.courierdeliverysystem;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
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

public class DelManInfo extends ActionBarActivity {
	int px,py;
	boolean IstabTouched=false;
	String id;
	ConnectThread connectThread;
	public static boolean Isconnecting;
	String info="";
	String infodiv[];
	String id_Num="»ç¿ø¹øÈ£: ";
	String name="ÀÌ¸§: ";
	String Phone="ÈÞ´ëÈ¥: ";
	String Income="ÃÑ ¼öÀÍ: ";
	
	@Override
	protected void onCreate(Bundle savedInstanceState){
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_del_man_info);	
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=2;
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
		 Income+=infodiv[3];
		 
		((TextView)findViewById(R.id.t_delman_id)).setText(id_Num);
		((TextView)findViewById(R.id.t_delman_Name)).setText(name);
		((TextView)findViewById(R.id.t_delman_Phone)).setText(Phone);
		((TextView)findViewById(R.id.t_income)).setText(Income);
		// findViewById(R.id.t_delman_id).setText		 
	}
	/**
	 * A placeholder fragment containing a simple view.
	 */
	
	@Override
	 public boolean onTouchEvent(MotionEvent event){
			
		px =(int)event.getX();
		py =(int)event.getY();
		
		if(px>345 && py<250 && !IstabTouched){
			IstabTouched =true;
			Intent intent = new Intent(this, DelProductInfo.class);
			intent.putExtra("id", id);
			startActivity(intent);
			overridePendingTransition(android.R.anim.fade_in, R.anim.abc_fade_out);
			finish();		
		}					
		 return super.onTouchEvent(event);		 
	 }
}
