package com.abdulr.lestaribuah.Views.LoginRegister;

import android.app.Dialog;
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
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener {
    public Config config;
    public Session session;
    API api;
    AutoCompleteTextView atEmail, atPassword;
    Button btnLogin, btnRegister;

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
        btnRegister = findViewById(R.id.btnRegister);

        btnLogin.setOnClickListener(this);
        btnRegister.setOnClickListener(this);

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

                        doLogin(obj);
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
                break;

            case R.id.btnRegister:
                if(validate()) {
                    final JSONObject obj = new JSONObject();
                    try {
                        obj.put("email", atEmail.getText().toString());
                        obj.put("password", atPassword.getText().toString());

                        final Dialog dialog = new Dialog(this);
                        dialog.setContentView(R.layout.dialog_register);
                        dialog.setCanceledOnTouchOutside(false);
                        dialog.setCancelable(false);

                        final AutoCompleteTextView atFullname = dialog.findViewById(R.id.atFullname);
                        Button btnNext = dialog.findViewById(R.id.btnNext);
                        Button btnCancel = dialog.findViewById(R.id.btnCancel);

                        btnCancel.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View view) {
                                dialog.dismiss();
                            }
                        });

                        btnNext.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View view) {
                                if(atFullname.getText().toString().equals("")) {
                                    Toast.makeText(LoginActivity.this, "Nama Lengkap harus diisi !", Toast.LENGTH_SHORT).show();
                                } else {
                                    try {
                                        obj.put("nama_lengkap", atFullname.getText().toString());
                                        doRegister(obj);
                                        dialog.dismiss();
                                    } catch (JSONException e) {
                                        e.printStackTrace();
                                    }
                                }
                            }
                        });
                        dialog.show();
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
                break;
        }
    }

    private void doLogin(final JSONObject obj) {
        FirebaseInstanceId.getInstance().getInstanceId().addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                api.login(LoginActivity.this, obj, instanceIdResult.getToken());
            }
        });
    }

    private void doRegister(final JSONObject obj) {
        FirebaseInstanceId.getInstance().getInstanceId().addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                api.register(LoginActivity.this, obj, instanceIdResult.getToken());
            }
        });
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
