package com.example.courierdeliverysystem;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.TextView;
import android.os.Build;

public class NonMemberPage extends ActionBarActivity {
	String id;
	ConnectThread connectThread;
	static public boolean Isconnecting;
	String info;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
		setContentView(R.layout.activity_non_member_page);
		
		Intent intent = getIntent();
		id = intent.getExtras().getString("id");
		
		connectThread = new ConnectThread(id);	
		connectThread.ThreadType=111;
		Isconnecting = true;
		connectThread.start();
		try {
			Thread.sleep(100);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		while(Isconnecting);
		info = connectThread.info;
		String delInfo[] = info.split(":");
		String temp ="날짜: "+delInfo[0]+"\n물품정보: "+delInfo[1]+"\n수신인: "+delInfo[2]+"\n배송정보: "+delInfo[3];
		((TextView)findViewById(R.id.text_NonMemInfo)).setText(temp);
		//((TextView)findViewById(R.id.t_delman_id)).setText(id_Num);
		if (savedInstanceState == null) {
			getSupportFragmentManager().beginTransaction()
					.add(R.id.container, new PlaceholderFragment()).commit();
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {

		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.non_member_page, menu);
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

	/**
	 * A placeholder fragment containing a simple view.
	 */
	public static class PlaceholderFragment extends Fragment {

		public PlaceholderFragment() {
		}

		@Override
		public View onCreateView(LayoutInflater inflater, ViewGroup container,
				Bundle savedInstanceState) {
			View rootView = inflater.inflate(R.layout.fragment_non_member_page,
					container, false);
			return rootView;
		}
	}

}
