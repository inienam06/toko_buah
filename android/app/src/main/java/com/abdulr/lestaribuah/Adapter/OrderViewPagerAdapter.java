package com.abdulr.lestaribuah.Adapter;

import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;
import android.util.Log;
import android.util.SparseArray;
import android.view.ViewGroup;

import com.abdulr.lestaribuah.Fragment.ArrivedTabFragment;
import com.abdulr.lestaribuah.Fragment.InOrderTabFragment;
import com.abdulr.lestaribuah.Fragment.WaitingTabFragment;

public class OrderViewPagerAdapter extends FragmentStatePagerAdapter {

    public OrderViewPagerAdapter(FragmentManager fm) {
        super(fm);

        notifyDataSetChanged();
    }
    @Override
    public Fragment getItem(int i) {
        switch (i) {
            case 0:
                return new WaitingTabFragment();

            case 1:
                return new InOrderTabFragment();

            case 2:
                return new ArrivedTabFragment();
        }

        return null;
    }

    @Override
    public int getCount() {
        return 3;
    }

    @Nullable
    @Override
    public CharSequence getPageTitle(int position) {
        switch (position) {
            case 0:
                return "Menunggu";

            case 1:
                return "Sedang Diantar";

            case 2:
                return "Telah Sampai";

            default:
                return null;
        }
    }
}
