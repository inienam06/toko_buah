package com.abdulr.lestaribuah.Data.Offline;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;

public class Session {
    private static final String appName = "Toko Buah";
    private static final int id = 0;
    private static final String nama = "";
    private static final String email = "";
    private static final String noHp = "";
    private static final String token = "";
    private static final String tokenFirebase = "";
    private static final Boolean isLogin = false;
    private SharedPreferences sp;
    private SharedPreferences.Editor spEditor;

    @SuppressLint("CommitPrefEdits")
    public Session(Context context) {
        sp = context.getSharedPreferences(appName, Context.MODE_PRIVATE);
        spEditor = sp.edit();
    }

    //SETTER
    public void setId(int value) {
        spEditor.putInt("id", value);
        spEditor.commit();
    }

    public void setNama(String value) {
        spEditor.putString("nama", value);
        spEditor.commit();
    }

    public void setEmail(String value) {
        spEditor.putString("email", value);
        spEditor.commit();
    }

    public void setNoHp(String value) {
        spEditor.putString("noHp", value);
        spEditor.commit();
    }

    public void setToken(String value) {
        spEditor.putString("token",value);
        spEditor.commit();
    }

    public void setTokenFirebase(String value) {
        spEditor.putString("tokenFirebase",value);
        spEditor.commit();
    }

    public void setIsLogin (Boolean value) {
        spEditor.putBoolean("isLogin", value);
        spEditor.commit();
    }

    public void login(int id, String nama, String email, String noHp, String token, String tokenFirebase) {
        spEditor.putInt("id", id);
        spEditor.putString("nama", nama);
        spEditor.putString("email", email);
        spEditor.putString("noHp", noHp);
        spEditor.putString("token", token);
        spEditor.putString("tokenFirebase", tokenFirebase);
        spEditor.putBoolean("isLogin", true);
        spEditor.commit();
    }
    //ENDSETTER


    //GETTER
    public int getId() {
        return sp.getInt("id", id);
    }

    public String getNama() {
        return sp.getString("nama",nama);
    }

    public String getEmail() {
        return sp.getString("email",email);
    }

    public String getNoHp() {
        return sp.getString("noHp",noHp);
    }

    public String getToken() {
        return sp.getString("token",token);
    }

    public String getTokenFirebase() {
        return sp.getString("tokenFirebase",tokenFirebase);
    }

    public Boolean getIsLogin() {
        return sp.getBoolean("isLogin", isLogin);
    }

    public void logout() {
        spEditor.putInt("id", id);
        spEditor.putString("nama", nama);
        spEditor.putString("email", email);
        spEditor.putString("noHp", noHp);
        spEditor.putString("token", token);
        spEditor.putString("tokenFirebase", tokenFirebase);
        spEditor.putBoolean("isLogin", isLogin);
        spEditor.commit();
    }
    //ENDGETTER
}
