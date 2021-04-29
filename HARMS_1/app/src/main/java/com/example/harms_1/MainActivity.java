package com.example.harms_1;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.provider.Settings;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.joda.time.LocalDateTime;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

// imports

public class MainActivity extends AppCompatActivity {
    private static final String url = "http://192.168.1.30/LoginRegister/Notifications.php";
    List<Result> resultList;
    Button loginBtn;
    EditText textInputEditTextUsername, textInputEditTextPassword;
    ProgressBar progressBar;
    boolean hasLoggedIn;
    SharedPreferences settings;

    @RequiresApi(api = Build.VERSION_CODES.O)
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        settings = getSharedPreferences(SaveSharedPreference.PREFS_NAME, 0);
        //Get "hasLoggedIn" value. If the value doesn't exist yet false is returned
        hasLoggedIn = settings.getBoolean("hasLoggedIn", false);
        resultList = new ArrayList<>();
        if(hasLoggedIn) {
            //Go directly to main activity.
            Intent intent = new Intent(getApplicationContext(), Home.class);
            startActivity(intent);
            finish();


        }
        callUNotify();
        content();
        loginBtn = findViewById(R.id.button3);
        textInputEditTextUsername = findViewById(R.id.usernamelET);
        textInputEditTextPassword = findViewById(R.id.passwordET);
        progressBar = findViewById(R.id.indeterminateBar);
        progressBar.setVisibility(View.INVISIBLE);

        loginBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                final String username, password;
                username = String.valueOf(textInputEditTextUsername.getText());
                password = String.valueOf(textInputEditTextPassword.getText());

                if(!username.equals("") && !password.equals("")){
                    progressBar.setVisibility(View.VISIBLE);
                    Handler handler = new Handler();
                    handler.post(new Runnable() {
                        @Override
                        public void run() {
                            //Starting Write and Read data with URL
                            //Creating array for parameters
                            String[] field = new String[2];
                            field[0] = "username";
                            field[1] = "password";
                            //Creating array for data
                            String[] data = new String[2];
                            data[0] = username;
                            data[1] = password;
                            PutData putData = new PutData("http://192.168.1.30/LoginRegister/login.php", "POST", field, data);
                            if (putData.startPut()) {
                                if (putData.onComplete()) {
                                    progressBar.setVisibility(View.GONE);
                                    String result = putData.getResult();
                                    if(result.equals("Login Success")){
                                        Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
                                        Intent intent = new Intent(getApplicationContext(), Home.class);
                                        //User has successfully logged in, save this information
                                        // We need an Editor object to make preference changes.
                                        SharedPreferences settings = getSharedPreferences(SaveSharedPreference.PREFS_NAME, 0); // 0 - for private mode
                                        SharedPreferences.Editor editor = settings.edit();

                                        //Set "hasLoggedIn" to true
                                        editor.putBoolean("hasLoggedIn", true);
                                        editor.putString("username",username);
                                        editor.putString("password",password);
                                        // Commit the edits!
                                        editor.commit();
                                        startActivity(intent);
                                        finish();
                                    }
                                    //End ProgressBar (Set visibility to GONE)
                                   // Log.i("PutData", result);
                                    else{
                                        Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
                                        }
                                }
                            }
                            //End Write and Read data with URL
                        }
                    });

                }

            }
        });

  }


    public void showFacebookPage(View v){

        Intent i = new Intent(Intent.ACTION_VIEW);
        i.setData(Uri.parse("https://www.facebook.com/pages/CCSIT-kfu/130968030422837"));
        startActivity(i);


    }

    public void showGoogleAccount(View v){

        Intent i = new Intent(Intent.ACTION_VIEW);
        i.setData(Uri.parse("https://www.google.com"));
        startActivity(i);
    }

    public void showTwitterAccount(View v){

        Intent i = new Intent(Intent.ACTION_VIEW);
        i.setData(Uri.parse("https://www.twitter.com"));
        startActivity(i);
    }
    public void refresh(int millisecond){
        final Handler handler = new Handler();
        final Runnable runnable= new Runnable() {
            @RequiresApi(api = Build.VERSION_CODES.O)
            @Override
            public void run() {
                content();
                System.out.println("uuuiii");

            }
        };
        handler.postDelayed(runnable, millisecond);

    }

    public void content(){
        int count= 0;


            DateFormat dateFormat = new SimpleDateFormat("HH:mm:ss");
            Calendar cal = Calendar.getInstance();
            String now =dateFormat.format(cal.getTime());
            System.out.println(dateFormat.format(cal.getTime()));
            if(resultList!=null){
                for (int i = 0; i < resultList.size(); i++) {
                    try {
                        Log.v("hgmu",now+"");
                        if(now.equals(resultList.get(i).getTime()))
                        sendNotification(resultList.get(i).getAppliance_Name(),resultList.get(i).getRoom_Name(),resultList.get(i).getTime());

                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                    //   if (childid==calculateAge(childsList.get(i).getBirth())){
                    // chosechild.setSE(childsList.get(i).getName());
                    //  }
                }}



        count++;        //sendNotification("gb","fghf","grt");
        callUNotify();
        refresh(1000);
    }


    public void callUNotify(){

       // final SharedPreferences sharedPreferences =this.getSharedPreferences("AppointmentNumber", Context.MODE_PRIVATE);

     //   final String oldvalue = sharedPreferences.getString("apponum", null);


                //TMessage.message(getContext(), "old value " + oldvalue + "");

                StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                try {
                                    //converting the string to json array object
                                    JSONArray array = new JSONArray(response);

                                    //traversing through all the object
                                    for (int i = 0; i < array.length(); i++) {

                                        //getting actions object from json array
                                        JSONObject result = array.getJSONObject(i);
                                        //adding the actions to cards list
                                        System.out.println(result.getInt("result_id")+"kjkjjjjjjjj");

                                        resultList.add(new Result(
                                                result.getInt("result_id"),
                                                result.getString("Room_Name"),
                                                result.getString("Appliance_Name"),
                                                result.getString("time"),
                                                result.getInt("state")

                                        ));
                                    }

                                    //creating adapter object and setting it to recyclerview

                                } catch (JSONException e) {
                                    e.printStackTrace();
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(getApplicationContext(), " Try again later ", Toast.LENGTH_SHORT).show();
                            }
                        });

                //adding our string request to queue
                Volley.newRequestQueue(MainActivity.this).add(stringRequest);

            }

    public static String createNotificationChannel(Context context) {

        // NotificationChannels are required for Notifications on O (API 26) and above.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {

            // The id of the channel.
            String channelId = "Channel_id";

            // The user-visible name of the channel.
            CharSequence channelName = "Application_name";
            // The user-visible description of the channel.
            String channelDescription = "Application_name Alert";
            int channelImportance = NotificationManager.IMPORTANCE_DEFAULT;
            boolean channelEnableVibrate = true;
//            int channelLockscreenVisibility = Notification.;

            // Initializes NotificationChannel.
            NotificationChannel notificationChannel = new NotificationChannel(channelId, channelName, channelImportance);
            notificationChannel.setDescription(channelDescription);
            notificationChannel.enableVibration(channelEnableVibrate);
//            notificationChannel.setLockscreenVisibility(channelLockscreenVisibility);

            // Adds NotificationChannel to system. Attempting to create an existing notification
            // channel with its original values performs no operation, so it's safe to perform the
            // below sequence.
            NotificationManager notificationManager = (NotificationManager) context.getSystemService(Context.NOTIFICATION_SERVICE);
            assert notificationManager != null;
            notificationManager.createNotificationChannel(notificationChannel);

            return channelId;
        } else {
            // Returns null for pre-O (26) devices.
            return null;
        }
    }

    public void sendNotification(String app, String perm, String times) {
        String message ="Appliance_Name:"+ app+ " Room_Name:"+perm+ "";
        String channel_id = createNotificationChannel(this);

        int m = (int) ((new Date().getTime() / 1000L) % Integer.MAX_VALUE);



        NotificationCompat.Builder builder = new NotificationCompat.Builder(MainActivity.this, channel_id);
        builder.setSmallIcon(R.drawable.hospital);


        Intent intent = new Intent();
        intent.setAction(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        Uri uri = Uri.fromParts("package", "pkgName", null);
        intent.setData(uri);


        PendingIntent pendingIntent = PendingIntent.getActivity(MainActivity.this, 0, intent, 0);
        builder.setContentIntent(pendingIntent);
        builder.setLargeIcon(BitmapFactory.decodeResource(getResources(), R.drawable.hospital));
        builder.setContentTitle("لديك اشعارات جديدة");
        builder.setStyle(new NotificationCompat.BigTextStyle()
                .setBigContentTitle(app)
                .setSummaryText(app)

                .bigText(message));

        builder.setContentText(message);
        builder.setContentIntent(pendingIntent);


        NotificationManager notificationManager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);

        // Will display the notification in the notification bar
        notificationManager.notify(m, builder.build());
    }

}