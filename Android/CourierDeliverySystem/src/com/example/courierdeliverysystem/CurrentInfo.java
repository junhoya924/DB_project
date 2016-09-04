package com.example.courierdeliverysystem;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
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
import android.os.Build;
import android.widget.ImageView;
import android.widget.TextView;


public class CurrentInfo extends ActionBarActivity {
	int px,py;
	String id;
	boolean IstabTouched;
	String stateText;
	static public boolean Isconnecting;
	ConnectThread connectThread;
	String info;
	String infodel[];
	int delType=0;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_current_info);
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=3;
		Isconnecting = true;
		connectThread.start();
		try {
			Thread.sleep(100);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		while(Isconnecting);
		info = connectThread.info;
		
		infodel = info.split(":");
		
		Log.d("Delever",info);
		Bitmap bmp;
		if(infodel[0].matches("0")){			
			bmp = BitmapFactory.decodeResource(getResources(),R.drawable.empty);
			((ImageView)findViewById(R.id.CurrentStateImage)).setImageBitmap(bmp);
			stateText ="고객님은 현재 배송중인 택배가 없습니다.";
		}
		else{
			bmp = BitmapFactory.decodeResource(getResources(),R.drawable.delevering);
			((ImageView)findViewById(R.id.CurrentStateImage)).setImageBitmap(bmp);			
			stateText ="고객님은 현재"; //배송중인 택배가 없습니다.";	
			stateText+=infodel[1];
			stateText+="개의 택배가 배송 준비중이며\n";
			stateText+=infodel[2];
			stateText+="개의 택배가 배송중입니다";
		}
			
		((TextView)findViewById(R.id.StateTextView)).setText(stateText);	
		IstabTouched = false;
	}
	
	@Override
	 public boolean onTouchEvent(MotionEvent event){
			
		px =(int)event.getX();
		py =(int)event.getY();
		
		if(px>250 &&px<=500&& py<250 && !IstabTouched){
			IstabTouched =true;
			Intent intent = new Intent(this, DeleveryInfo.class);
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
		getMenuInflater().inflate(R.menu.current_info, menu);
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
