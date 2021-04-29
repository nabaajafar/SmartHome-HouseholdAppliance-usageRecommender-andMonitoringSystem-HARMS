package com.example.harms_1;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Build;
import android.os.Bundle;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

public class Dashboard extends AppCompatActivity {

    SharedPreferences settings;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        WebView webview = (WebView)findViewById(R.id.web1);

         //enable using javascript
        webview.getSettings().setDomStorageEnabled(true);
        webview.loadUrl("http://192.168.1.30/HARMS_Project/index.php");
        webview.getSettings().setJavaScriptEnabled(true);
        webview.setWebViewClient(new MyBrowser());

    }

    private class MyBrowser extends WebViewClient {

        @Override
        public void onPageFinished(WebView view, String url) {
            super.onPageFinished(view, url);

            settings = getSharedPreferences(SaveSharedPreference.PREFS_NAME, 0);

            String username = settings.getString("username",null);
            String password = settings.getString("password",null);

            view.loadUrl("javascript:(function() { document.getElementById('username').value = '" + username + "'; ;})()");
            view.loadUrl("javascript:(function() { document.getElementById('pass').value = '" + password + "'; ;})()");
            view.loadUrl("javascript:(function() { var z = document.getElementById('Login').click(); })()");
        }
    }
}
