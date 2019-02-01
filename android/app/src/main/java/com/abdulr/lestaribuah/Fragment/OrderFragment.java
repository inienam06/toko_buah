package com.abdulr.lestaribuah.Fragment;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.view.ViewPager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.abdulr.lestaribuah.Adapter.OrderViewPagerAdapter;
import com.abdulr.lestaribuah.R;

public class OrderFragment extends Fragment {
    ViewPager vpOrder;
    TabLayout tabOrder;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_order, container, false);

        initXML(v);
        getData();
        return v;
    }

    private void initXML(View v) {
        vpOrder = v.findViewById(R.id.vpOrder);
        tabOrder = v.findViewById(R.id.tabOrder);
    }

    private void getData() {
        OrderViewPagerAdapter adapter = new OrderViewPagerAdapter(getFragmentManager());
        int limit = (adapter.getCount() > 1) ? adapter.getCount() - 1 : 1;

        vpOrder.setAdapter(adapter);
        tabOrder.setupWithViewPager(vpOrder, true);

        vpOrder.setOffscreenPageLimit(limit);
    }
}
