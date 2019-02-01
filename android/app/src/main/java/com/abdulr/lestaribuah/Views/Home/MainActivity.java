package com.abdulr.lestaribuah.Views.Home;

import android.annotation.SuppressLint;
import android.app.SearchManager;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.MenuInflater;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.support.v7.widget.SearchView;
import android.widget.Toast;

import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.Data.Online.API;
import com.abdulr.lestaribuah.Fragment.AccountFragment;
import com.abdulr.lestaribuah.Fragment.HistoryFragment;
import com.abdulr.lestaribuah.Fragment.HomeFragment;
import com.abdulr.lestaribuah.Fragment.OrderFragment;
import com.abdulr.lestaribuah.R;
import com.abdulr.lestaribuah.Views.LoginRegister.LoginActivity;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;
import com.google.firebase.messaging.FirebaseMessaging;

import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener, BottomNavigationView.OnNavigationItemSelectedListener {

    API api = new API();
    public Session session;
    public Config config;
    BottomNavigationView navBottom;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FirebaseMessaging.getInstance().setAutoInitEnabled(true);
        session = new Session(this);
        config = new Config(this);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = findViewById(R.id.toolbar);
         navBottom = findViewById(R.id.bnMain);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = findViewById(R.id.nav_view);
        
        loadMain(new HomeFragment());

        if(!session.getIsLogin()) {
            navigationView.getMenu().clear();

            navigationView.inflateMenu(R.menu.menu_drawer_before_login);
        } else {
            final JSONObject obj = new JSONObject();
            config.loading(1);
            FirebaseInstanceId.getInstance().getInstanceId().addOnSuccessListener(new OnSuccessListener<InstanceIdResult>() {
                @Override
                public void onSuccess(InstanceIdResult instanceIdResult) {
                    try {
                        obj.put("id_user", session.getId());
                        obj.put("token", instanceIdResult.getToken());

                        api.update_firebase(MainActivity.this, obj);
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    config.loading(0);
                }
            });
        }

        navigationView.setNavigationItemSelectedListener(this);
        navBottom.setOnNavigationItemSelectedListener(this);
    }

    @SuppressLint("CommitTransaction")
    private boolean loadMain(Fragment fragment) {
        if(fragment != null) {
            getSupportFragmentManager()
                    .beginTransaction()
                    .replace(R.id.fMain, fragment)
                    .setCustomAnimations(android.R.anim.slide_in_left, android.R.anim.slide_out_right)
                    .commit();
            return true;
        }

        return false;
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        MenuInflater menuInflater = getMenuInflater();
        menuInflater.inflate(R.menu.menu_search, menu);

        MenuItem searchItem = menu.findItem(R.id.action_search);

        SearchManager searchManager = (SearchManager) MainActivity.this.getSystemService(Context.SEARCH_SERVICE);

        SearchView searchView = null;
        if (searchItem != null) {
            searchView = (SearchView) searchItem.getActionView();
        }
        if (searchView != null) {
            if (searchManager != null) {
                searchView.setSearchableInfo(searchManager.getSearchableInfo(MainActivity.this.getComponentName()));
            }
        }
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        Fragment fragment = null;
        int id = item.getItemId();

        switch (id) {
            case R.id.nav_login:
                startActivity(config.goIntent(LoginActivity.class, 0, null, null));
                break;

            case R.id.nav_logout:
                config.messageYesNo("Apa anda yakin akan keluar dari akun anda ?", 3, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        session.logout();
                        startActivity(getIntent());
                    }
                }, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                    }
                });
                break;

            case R.id.nav_pengaturan:
                Toast.makeText(this, "Pengaturan Akun", Toast.LENGTH_SHORT).show();
                break;

            case R.id.bottom_home:
                if(id != navBottom.getSelectedItemId()) {
                    return loadMain(new HomeFragment());
                }
                break;

            case R.id.bottom_order:
                if(!session.getIsLogin()) {
                    Toast.makeText(this, "Anda harus login terlebih dahulu !", Toast.LENGTH_SHORT).show();
                    break;
                }

                if(id != navBottom.getSelectedItemId()) {
                    return loadMain(new OrderFragment());
                }
                break;

            case R.id.bottom_history:
                if(!session.getIsLogin()) {
                    Toast.makeText(this, "Anda harus login terlebih dahulu !", Toast.LENGTH_SHORT).show();
                    break;
                }

                if(id != navBottom.getSelectedItemId()) {
                    return loadMain(new HistoryFragment());
                }
                break;

            case R.id.bottom_account:
                if(!session.getIsLogin()) {
                    Toast.makeText(this, "Anda harus login terlebih dahulu !", Toast.LENGTH_SHORT).show();

                    break;
                }

                if(id != navBottom.getSelectedItemId()) {
                    return loadMain(new AccountFragment());
                }
                break;
        }

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
