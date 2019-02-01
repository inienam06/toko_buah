package com.abdulr.lestaribuah.Views;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.WindowManager;
import android.widget.ProgressBar;

import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.R;
import com.abdulr.lestaribuah.Views.Home.MainActivity;
import com.abdulr.lestaribuah.Views.LoginRegister.LoginActivity;

public class SplashScreenActivity extends AppCompatActivity {
    ProgressBar pbLoading;
    Config config;
    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);

        pbLoading = findViewById(R.id.pbLoading);
        config = new Config(this);
        session = new Session(this);

        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                if(config.isNetworkAvailable()) {
                    startActivity(config.goIntent(MainActivity.class, 0, null, null));
                    finish();
                } else {
                    finish();
                }
            }
        }, 2000);
    }
}
