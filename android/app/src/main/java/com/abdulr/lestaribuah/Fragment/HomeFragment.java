package com.abdulr.lestaribuah.Fragment;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.abdulr.lestaribuah.Adapter.HomeTerbaruAdapter;
import com.abdulr.lestaribuah.Adapter.HomeTerpopulerAdapter;
import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.Data.Online.API;
import com.abdulr.lestaribuah.R;

import org.json.JSONArray;

import java.text.DecimalFormat;

public class HomeFragment extends Fragment {
    public API api;
    public Config config;
    public Session session;
    public RecyclerView rvTerpopuler, rvTerbaru;
    public DecimalFormat decimal = new DecimalFormat("#,###,###");

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_home, container, false);

        initXML(v);
        getData();

        return v;
    }

    private void initXML(View v) {
        api = new API();
        config = new Config(getActivity());
        session = new Session(getActivity());

        rvTerpopuler = v.findViewById(R.id.rvTerpopuler);
        rvTerbaru = v.findViewById(R.id.rvTerbaru);

        rvTerpopuler.setLayoutManager(new LinearLayoutManager(getActivity()));
        rvTerbaru.setLayoutManager(new LinearLayoutManager(getActivity()));

        rvTerpopuler.setHasFixedSize(true);
        rvTerbaru.setHasFixedSize(true);
    }

    private void getData() {
        api.getBeranda(this);
    }

    public void setBeranda(JSONArray terpopuler, JSONArray terbaru) {
        HomeTerpopulerAdapter adapterTerpopuler = new HomeTerpopulerAdapter(this, terpopuler);
        HomeTerbaruAdapter adapterTerbaru = new HomeTerbaruAdapter(this, terbaru);

        rvTerpopuler.setAdapter(adapterTerpopuler);
        rvTerbaru.setAdapter(adapterTerbaru);
    }
}
