package com.abdulr.lestaribuah.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.abdulr.lestaribuah.Data.Online.LoadImage;
import com.abdulr.lestaribuah.Fragment.HistoryFragment;
import com.abdulr.lestaribuah.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class HistoryAdapter extends RecyclerView.Adapter<HistoryAdapter.Holder> {
    private HistoryFragment fragment;
    private JSONArray data;

    public HistoryAdapter(HistoryFragment fragment, JSONArray data) {
        this.fragment = fragment;
        this.data = data;

        notifyDataSetChanged();
    }

    @NonNull
    @Override
    public HistoryAdapter.Holder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View v = LayoutInflater.from(fragment.getActivity()).inflate(R.layout.content_history, viewGroup,false);

        return new HistoryAdapter.Holder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull HistoryAdapter.Holder holder, int i) {
        try {
            JSONObject obj = data.getJSONObject(i);
            JSONObject produk = obj.getJSONObject("produk");

            String name = produk.getString("nama_produk");
            int price = obj.getInt("total_harga");
            int views = obj.getInt("kilo");
            String date = obj.getString("updated_at");
            String path = fragment.api.getBaseUrl() + produk.getString("url_foto") + produk.getString("foto_produk");

            holder.tvProductName.setText(name);
            holder.tvProductPrice.setText(fragment.decimal.format(price));
            holder.tvProductWeight.setText(fragment.decimal.format(views) + "KG");
            holder.tvProductDate.setText(date);

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
        TextView tvProductName, tvProductPrice, tvProductWeight, tvProductDate;
        ImageView ivProductImage;

        Holder(@NonNull View v) {
            super(v);

            tvProductName = v.findViewById(R.id.tvProductName);
            tvProductPrice = v.findViewById(R.id.tvProductPrice);
            tvProductWeight = v.findViewById(R.id.tvProductWeight);
            tvProductDate = v.findViewById(R.id.tvProductDate);
            ivProductImage = v.findViewById(R.id.ivProductImage);
        }
    }
}
