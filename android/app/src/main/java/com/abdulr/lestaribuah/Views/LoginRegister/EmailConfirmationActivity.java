package com.abdulr.lestaribuah.Views.LoginRegister;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.Data.Online.API;
import com.abdulr.lestaribuah.R;

public class EmailConfirmationActivity extends AppCompatActivity implements View.OnClickListener {
    public Config config;
    EditText etCode;
    Button btnConfirm;
    API api;
    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_email_confirmation);

        initXML();
        initToolbar();
    }

    private void initXML() {
        config = new Config(this);
        api = new API();
        session = new Session(this);

        etCode = findViewById(R.id.etCode);
        btnConfirm = findViewById(R.id.btnConfirm);

        btnConfirm.setOnClickListener(this);
    }

    private void initToolbar() {
        config.defaultToolbar(getSupportActionBar(), "E-mail Confirmation", true, this, 1);
    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnConfirm:
                if(etCode.getText().toString().equals("")) {
                    Toast.makeText(this, "Silahkan masukkan kode konfimasi !", Toast.LENGTH_SHORT).show();
                } else {
                }
                break;
        }
    }
}
