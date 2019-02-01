package com.abdulr.lestaribuah.Views.LoginRegister;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.Toast;

import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.Data.Online.API;
import com.abdulr.lestaribuah.R;
import com.google.firebase.iid.FirebaseInstanceId;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener {
    public Config config;
    public Session session;
    API api;
    AutoCompleteTextView atEmail, atPassword;
    Button btnLogin;
    String token;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        initXML();
    }

    private void initXML() {
        config = new Config(this);
        api = new API();
        session = new Session(this);

        atEmail = findViewById(R.id.atEmail);
        atPassword = findViewById(R.id.atPassword);
        btnLogin = findViewById(R.id.btnLogin);

        btnLogin.setOnClickListener(this);

        if(!config.checkPermission(config.listPermission(0))) {
            config.allowPermission(0);
        }
    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnLogin:
                if(validate()) {
                    JSONObject obj = new JSONObject();
                    try {
                        obj.put("email", atEmail.getText().toString());
                        obj.put("password", atPassword.getText().toString());

                        api.login(LoginActivity.this, obj);
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
                break;
        }
    }

    private Boolean validate() {
        if(atEmail.getText().toString().equals("")) {
            Toast.makeText(this, "E-mail harus diisi !", Toast.LENGTH_SHORT).show();
            return false;
        }

        if(atPassword.getText().toString().equals("")) {
            Toast.makeText(this, "Password harus diisi !", Toast.LENGTH_SHORT).show();
            return false;
        }

        return true;
    }
}
