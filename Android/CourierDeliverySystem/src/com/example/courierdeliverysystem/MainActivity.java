package com.example.courierdeliverysystem;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Locale;

import android.support.v7.app.ActionBarActivity;
import android.content.Intent;
import android.location.Geocoder;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.Menu;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.*;


public class MainActivity extends ActionBarActivity implements OnClickListener {
	
	public static boolean login_ing ;
	public static boolean succeed= false; ;
	RadioGroup group;
	int m_Client;
	String json;
	StringBuffer sbuffer;
	String id;
	ConnectThread connectThread;
    @Override
    protected void onCreate(Bundle savedInstanceState){			
    	//setTheme(android.R.style.Theme_NoTitleBar_Fullscreen);
        super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN );
        setContentView(R.layout.activity_main);
        m_Client =0;
        
        connectThread = null;
        group =(RadioGroup) findViewById(R.id.ClientGroup);       
        findViewById(R.id.Lon_in).setOnClickListener(this);
        
        group.setOnCheckedChangeListener(
        		new RadioGroup.OnCheckedChangeListener() {				
					@Override
					public void onCheckedChanged(RadioGroup group, int checkedId) {
						// TODO Auto-generated method stub
						switch(checkedId){
						case R.id.radio_Client:
							m_Client = 0;
							((EditText)findViewById(R.id.edit_PW)).setVisibility(View.VISIBLE);
							((TextView)findViewById(R.id.TextMenu_PW)).setVisibility(View.VISIBLE);
							break;
						case R.id.radio_Delevery:
							m_Client =1;
							((EditText)findViewById(R.id.edit_PW)).setVisibility(View.VISIBLE);
							((TextView)findViewById(R.id.TextMenu_PW)).setVisibility(View.VISIBLE);
							break;
						case R.id.radioButton1:
							m_Client =2;
							((EditText)findViewById(R.id.edit_PW)).setVisibility(View.INVISIBLE);
							((TextView)findViewById(R.id.TextMenu_PW)).setVisibility(View.INVISIBLE);			
							break;		
						default:
							break;
						}						
					}
				});    	
        };
    
	@Override
	public void onClick(View v) {
		//succeed = false;
		login_ing = true;
		EditText t_id = ((EditText)findViewById(R.id.edit_ID));	
		EditText t_pw = ((EditText)findViewById(R.id.edit_PW));
		connectThread = new ConnectThread(t_id.getText().toString(),t_pw.getText().toString(),m_Client);
		connectThread.ThreadType=0;
		if(m_Client==2)
			connectThread.ThreadType=100;	
		connectThread.start();

		while(login_ing);
		if(succeed){
			Intent intent;
			switch(m_Client){
			default:
			case 0:
				intent = new Intent(this, CurrentInfo.class);
				intent.putExtra("id",t_id.getText().toString());
				break;
			case 1:
				intent = new Intent(this, DelManInfo.class);
				intent.putExtra("id",t_id.getText().toString());
				break;	
			case 2:
				intent = new Intent(this, NonMemberPage.class);
				intent.putExtra("id",t_id.getText().toString());
				break;	
		}
		startActivity(intent);
		finish();
		}
		else{
			Toast t =Toast.makeText(this,"Login failed", 130);
			t.setGravity(Gravity.CENTER,0,0);
			t.show();
		}
	}
	
	//Setting _Menu
   @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

}
