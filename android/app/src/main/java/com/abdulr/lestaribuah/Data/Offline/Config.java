package com.abdulr.lestaribuah.Data.Offline;

import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Build;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.ActionBar;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;
import android.support.v7.widget.Toolbar;

import com.abdulr.lestaribuah.R;

public class Config {
    Activity activity;
    ProgressDialog progress;

    public Config(Activity activity) {
        this.activity = activity;
        this.progress = new ProgressDialog(activity);
    }

    public void defaultToolbar(ActionBar actionBar, String titleActiobar, Boolean showBackBotton, final Activity activity, int code) {
        actionBar.setDisplayOptions(ActionBar.DISPLAY_SHOW_CUSTOM);
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setCustomView(R.layout.toolbal_default);
        actionBar.setElevation(0);

        Toolbar toolbar=(Toolbar)actionBar.getCustomView().getParent();

        //title
        TextView title = toolbar.findViewById(R.id.title);
        title.setText(titleActiobar.toUpperCase());

        ImageButton back = toolbar.findViewById(R.id.btn_back);

        toolbar.setContentInsetsAbsolute(0, 0);
        toolbar.getContentInsetEnd();
        toolbar.setPadding(0, 0, 0, 0);

        if(!showBackBotton) {

            back.setVisibility(View.GONE);
            //actionBar.setDisplayHomeAsUpEnabled(true);
        }

        if(code == 1) {
            back.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    activity.onBackPressed();
                }
            });
        }
    }

    public Boolean validEmail(String email) {
        final String pattern = activity.getString(R.string.email_pattern);

        if(email.matches(pattern)) {
            return true;
        }

        return false;
    }

    public Intent goIntent(Class<?> tujuan, int code, @Nullable String[] name, @Nullable String[] value)
    {
         Intent i = new Intent(activity, tujuan)
                .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);


         switch (code) {
             case 1:
                 if (name != null && value != null) {
                     for (int pos = 0; pos < name.length; pos++) {
                         i.putExtra(name[pos], value[pos]);
                     }
                 }
                 break;

             default:

                 break;
         }

         return i;
    }

    public void messageYesNo(String message, int code, @Nullable DialogInterface.OnClickListener positive, @Nullable DialogInterface.OnClickListener negative) {
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);
        builder.setMessage(message);
        builder.setCancelable(false);
        switch (code) {
            case 0:

                break;

            case 1:
                builder.setPositiveButton("Yes", positive);
                break;

            case 2:
                builder.setNegativeButton("No", positive);
                break;

            case 3:
                builder.setPositiveButton("Yes", positive);
                builder.setNegativeButton("No", negative);
                break;
            default:

                break;
        }
        builder.create();
        builder.show();
    }

    public void messageOkCancel(String message, int code, @Nullable DialogInterface.OnClickListener positive, @Nullable DialogInterface.OnClickListener negative) {
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);
        builder.setMessage(message);
        builder.setCancelable(false);
        switch (code) {
            case 0:

                break;

            case 1:
                builder.setPositiveButton("Ok", positive);
                break;

            case 2:
                builder.setNegativeButton("Cancel", positive);
                break;

            case 3:
                builder.setPositiveButton("Ok", positive);
                builder.setNegativeButton("Cancel", negative);
                break;
            default:

                break;
        }
        builder.create();
        builder.show();
    }

    public String[] listPermission(int code) {
        String[] PERMISSION_REQUEST;
        final String[] defaultPermission = {
                Manifest.permission.INTERNET,
                Manifest.permission.ACCESS_NETWORK_STATE,
                Manifest.permission.WRITE_EXTERNAL_STORAGE,
                Manifest.permission.READ_EXTERNAL_STORAGE,
                Manifest.permission.READ_PHONE_STATE,
                Manifest.permission.CAMERA,
                Manifest.permission.ACCESS_FINE_LOCATION,
                Manifest.permission.ACCESS_COARSE_LOCATION
        };

        switch (code) {
            case 0:
                PERMISSION_REQUEST = defaultPermission;
                break;

            case 1:
                PERMISSION_REQUEST = new String[]{
                        Manifest.permission.INTERNET,
                        Manifest.permission.ACCESS_NETWORK_STATE
                };
                break;

            case 2:
                PERMISSION_REQUEST = new String[]{
                        Manifest.permission.WRITE_EXTERNAL_STORAGE,
                        Manifest.permission.READ_EXTERNAL_STORAGE
                };
                break;

            case 3:
                PERMISSION_REQUEST = new String[]{
                        Manifest.permission.READ_PHONE_STATE
                };
                break;

            case 4:
                PERMISSION_REQUEST = new String[]{
                        Manifest.permission.CAMERA
                };
                break;

            case 5:
                PERMISSION_REQUEST = new String[]{
                        Manifest.permission.ACCESS_FINE_LOCATION,
                        Manifest.permission.ACCESS_COARSE_LOCATION
                };
                break;

            default:
                PERMISSION_REQUEST = defaultPermission;
                break;
        }

        return PERMISSION_REQUEST;
    }

    public void allowPermission(int code) {
        if(!checkPermission(listPermission(code))) {
            ActivityCompat.requestPermissions(activity, listPermission(code), 1);
        }
    }

    public Boolean checkPermission(String... permission) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M && activity != null && permission != null) {
            for (String persn : permission) {
                if (ActivityCompat.checkSelfPermission(activity, persn) != PackageManager.PERMISSION_GRANTED) {
                    return false;
                }
            }
        }
        return true;
    }

    public void loading(int code) {
        switch (code) {
            case 1:
                progress.setMessage("Please Wait ...");
                progress.setCancelable(false);
                progress.show();
                break;

            case 0:
                progress.dismiss();
                break;
        }
    }

    public Boolean isNetworkAvailable() {
        ConnectivityManager connectivityManager = (ConnectivityManager) activity.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();

        if(activeNetworkInfo == null)
        {
            Toast.makeText(activity, activity.getString(R.string.connection_not_available), Toast.LENGTH_SHORT).show();
            return false;
        }
        
        return true;
    }
}
