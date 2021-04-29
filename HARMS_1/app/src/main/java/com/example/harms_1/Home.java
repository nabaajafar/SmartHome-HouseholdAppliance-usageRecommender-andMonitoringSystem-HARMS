package com.example.harms_1;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

public class Home extends AppCompatActivity {

    ImageView pat, abo,logou, dash;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        pat = findViewById(R.id.control);
        abo = findViewById(R.id.about);
        logou = findViewById(R.id.logoutim);
        dash = findViewById(R.id.dashimg);

        pat.setOnClickListener(new View.OnClickListener(){

            public void onClick(View view){
                Intent intent = new Intent(getApplicationContext(), Pattren.class);
                startActivity(intent);

            }
        });

        abo.setOnClickListener(new View.OnClickListener(){

            public void onClick(View view){
                Intent intent = new Intent(getApplicationContext(), AboutUs.class);
                startActivity(intent);

            }
        });

        logou.setOnClickListener(new View.OnClickListener(){

            public void onClick(View view){
                SharedPreferences preferences =getSharedPreferences(SaveSharedPreference.PREFS_NAME,0);
                SharedPreferences.Editor editor = preferences.edit();
                editor.clear();
                editor.apply();
                finish();
                Intent i = new Intent(getApplicationContext(),MainActivity.class);
                startActivity(i);
                finish();
            }
        });

        dash.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), Dashboard.class);
                startActivity(intent);
            }
        });

    }




}
