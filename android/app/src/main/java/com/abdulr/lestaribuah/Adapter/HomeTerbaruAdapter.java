package com.abdulr.lestaribuah.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.abdulr.lestaribuah.Data.Online.LoadImage;
import com.abdulr.lestaribuah.Fragment.HomeFragment;
import com.abdulr.lestaribuah.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class HomeTerbaruAdapter extends RecyclerView.Adapter<HomeTerbaruAdapter.Holder> {
    private HomeFragment fragment;
    private JSONArray data;

    public HomeTerbaruAdapter(HomeFragment fragment, JSONArray data) {
        this.fragment = fragment;
        this.data = data;

        notifyDataSetChanged();
    }

    @NonNull
    @Override
    public HomeTerbaruAdapter.Holder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View v = LayoutInflater.from(fragment.getActivity()).inflate(R.layout.content_main_terbaru, viewGroup,false);

        return new HomeTerbaruAdapter.Holder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull HomeTerbaruAdapter.Holder holder, int i) {
        try {
            JSONObject obj = data.getJSONObject(i);

            String name = obj.getString("nama_produk");
            int price = obj.getInt("harga");
            int views = obj.getInt("dilihat");
            String path = fragment.api.getBaseUrl() + obj.getString("url_foto") + obj.getString("foto_produk");

            holder.tvProductName.setText(name);
            holder.tvProductPrice.setText(fragment.decimal.format(price));
            holder.tvProductView.setText(fragment.decimal.format(views));

            new LoadImage(holder.ivProductImage, fragment.getActivity()).execute(path);

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    @Override
    public int getItemCount() {
        return data.length();
    }

    static class Holder extends RecyclerView.ViewHolder {
        TextView tvProductName, tvProductPrice, tvProductView;
        ImageView ivProductImage;

        Holder(@NonNull View v) {
            super(v);

            tvProductName = v.findViewById(R.id.tvProductName);
            tvProductPrice = v.findViewById(R.id.tvProductPrice);
            tvProductView = v.findViewById(R.id.tvProductView);
            ivProductImage = v.findViewById(R.id.ivProductImage);
        }
    }
}
