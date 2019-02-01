package com.abdulr.lestaribuah.Fragment;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.abdulr.lestaribuah.Adapter.OrderStatusInOrderAdapter;
import com.abdulr.lestaribuah.Data.Offline.Config;
import com.abdulr.lestaribuah.Data.Offline.Session;
import com.abdulr.lestaribuah.Data.Online.API;
import com.abdulr.lestaribuah.R;

import org.json.JSONArray;

import java.text.DecimalFormat;

public class InOrderTabFragment extends Fragment {
    public Config config;
    public Session session;
    public API api;
    public DecimalFormat decimal = new DecimalFormat("#,###,###");

    RecyclerView rvResult;
    TextView tvNoResult;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_in_order_tab, container, false);

        Log.d("fragment", "2");

        initXML(v);
        getData();

        return v;
    }

    private void initXML(View v) {
        api = new API();
        config = new Config(getActivity());
        session = new Session(getActivity());

        rvResult = v.findViewById(R.id.rvResult);
        tvNoResult = v.findViewById(R.id.tvNoResult);

        rvResult.setHasFixedSize(true);
        rvResult.setLayoutManager(new LinearLayoutManager(getActivity()));
    }

    private void getData() {
        api.getOrderStatusInOrder(this);
    }

    public void isExists() {
        rvResult.setVisibility(View.VISIBLE);
        tvNoResult.setVisibility(View.GONE);
    }

    public void isEmpty() {
        rvResult.setVisibility(View.GONE);
        tvNoResult.setVisibility(View.VISIBLE);
    }

    public void putData(JSONArray data) {
        OrderStatusInOrderAdapter adapter = new OrderStatusInOrderAdapter(this, data);

        rvResult.setAdapter(adapter);
    }
}
