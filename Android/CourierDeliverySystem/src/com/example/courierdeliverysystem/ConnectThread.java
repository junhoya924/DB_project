package com.example.courierdeliverysystem;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONArray;
import org.json.JSONObject;

import android.util.Log;

public class ConnectThread extends Thread {
		String id="";
		String pw="";
		String info ="";
		String review="";
		int client_Type;
		int ThreadType=0;
		public ConnectThread(String d_id, String d_pw, int m_Client) {
			id=d_id;
			pw=d_pw;
			client_Type =m_Client;
		}
		public ConnectThread(String d_id){
			id=d_id;
			// TODO Auto-generated constructor stub
		}
		public void run(){
			switch(ThreadType)
			{
			case 0:
			case 100:
				login();
				break;
			case 1:
			case 2:
				//login();
				printInfo();
				break;
			case 3:
				printCurrentInfo();
				break;
			case 4:
			case 5:
				printTodelList();
				break;
			case 6:
				printReceivedlList();
				break;
			case 10:
				UpdateProduct();
				break;
			case 111:
				printNonMemberinfo();
				break;
			case 66:
				UpdateEval();
				break;
			default:				
			}
		}
		public void printInfo(){
			try{
				String infoData="";//="?id="+id;
				if(ThreadType==1)			//Client의 경우, type을 0
					infoData="?id="+id+"&type="+"0";
				else if(ThreadType==2)
					infoData="?id="+id+"&type="+"1";
				URL url = new URL("http://163.180.173.95/DB/c_printinfo.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+infoData);
				HttpClient client = new DefaultHttpClient();			
				HttpResponse response = client.execute(post);				
					//서버에서 Data 받기		
				sleep(100);
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
				String line=null;				
				while((line = br.readLine())!=null){
					info += line;
				}		
				br.close();
				Log.d("Recv",info);			
				}catch(Exception e){
					e.printStackTrace();
				}
			if(ThreadType==1)
				PersonalInfo.Isconnecting=false;
			else if(ThreadType==2)
				DelManInfo.Isconnecting=false;
		}
		public void UpdateProduct()
		{
			try{
				String login_data="?id="+id;
				URL url = new URL("http://163.180.173.95/DB/update_courier.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+login_data);
				HttpClient client = new DefaultHttpClient();				
				HttpResponse response = client.execute(post);				
				//서버에서 Data 받기		
			sleep(100);
			BufferedReader br = new BufferedReader(
					new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
			String line=null;				
			while((line = br.readLine())!=null){
				info += line;
			}		
			br.close();
			Log.d("Recv",info);	
				
			}catch(Exception e){
				e.printStackTrace();
			}
		}
		public boolean login()
		{
			String login_data;
			try{
				if(ThreadType ==0)
					login_data="?id="+id+"&password="+pw+"&type="+client_Type;
				else
					login_data="?id="+id+"&type="+client_Type;
				URL url = new URL("http://163.180.173.95/DB/login_web.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+login_data);
				HttpClient client = new DefaultHttpClient();
				
				HttpResponse response = client.execute(post);
					
					//서버에서 Data 받기				
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));
					
				String line=null;
				String page="";
					
				while((line = br.readLine())!=null){
					page += line;
				}		
				if(page.equals("1"))
						MainActivity.succeed = true;
				Log.d("Recv",page);
				//JSONObject json = new JSONObject(page);
				//JSONArray jArr = json.getJSONArray("dataSend");
				br.close();
				}catch(Exception e){
					e.printStackTrace();
				}
			
			MainActivity.login_ing = false;
			return true;
		}
		public void printCurrentInfo(){
			try{
				String infoData="?id="+id;
				URL url = new URL("http://163.180.173.95/DB/c_courierinfo.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+infoData);
				HttpClient client = new DefaultHttpClient();			
				HttpResponse response = client.execute(post);					
				sleep(100);
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
				String line=null;				
				while((line = br.readLine())!=null){
					info += line;
				}		
				br.close();
				Log.d("Recv",info);			
				}catch(Exception e){
					e.printStackTrace();
				}
			
			CurrentInfo.Isconnecting=false;
		}
		public void printTodelList(){
			try{
				String infoData="?id="+id;
				URL url = new URL("http://163.180.173.95/DB/d_clientinfo.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+infoData);
				HttpClient client = new DefaultHttpClient();			
				HttpResponse response = client.execute(post);				
					//서버에서 Data 받기		
				sleep(100);
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
				String line=null;				
				while((line = br.readLine())!=null){
					info += line;
				}		
				br.close();
				Log.d("Recv",info);			
				}catch(Exception e){
					e.printStackTrace();
				}
				DelProductInfo.Isconnecting=false;
				MapViewActivity.Isconnecting=false;
		}
		public void printReceivedlList(){
			try{
				String infoData="?id="+id;
				URL url = new URL("http://163.180.173.95/DB/c_courier.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+infoData);
				HttpClient client = new DefaultHttpClient();			
				HttpResponse response = client.execute(post);				
					//서버에서 Data 받기		
				sleep(100);
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
				String line=null;				
				while((line = br.readLine())!=null){
					info += line;
				}		
				br.close();
				Log.d("Recv",info);			
				}catch(Exception e){
					e.printStackTrace();
				}
				DeleveryInfo.Isconnecting=false;
		}
		public void printNonMemberinfo(){
			try{
				String infoData="?id="+id;
				URL url = new URL("http://163.180.173.95/DB/n_courier.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+infoData);
				HttpClient client = new DefaultHttpClient();			
				HttpResponse response = client.execute(post);				
					//서버에서 Data 받기		
				sleep(100);
				BufferedReader br = new BufferedReader(
						new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
				String line=null;				
				while((line = br.readLine())!=null){
					info += line;
				}		
				br.close();
				Log.d("Recv",info);			
				}catch(Exception e){
					e.printStackTrace();
				}
				NonMemberPage.Isconnecting=false;
		}
		
		public void UpdateEval()
		{
			try{
				String login_data="?id="+id+"&info="+review;
				URL url = new URL("http://163.180.173.95/DB/update_evaluation.php");//c_printinfo.php				
				HttpPost post = new HttpPost(url+login_data);
				HttpClient client = new DefaultHttpClient();				
				HttpResponse response = client.execute(post);				
				//서버에서 Data 받기		
			sleep(100);
			BufferedReader br = new BufferedReader(
					new InputStreamReader(response.getEntity().getContent(),"UTF-8"));			
			String line=null;				
			while((line = br.readLine())!=null){
				info += line;
			}		
			br.close();
			Log.d("Recv",info);	
				
			}catch(Exception e){
				e.printStackTrace();
			}
		}
}
