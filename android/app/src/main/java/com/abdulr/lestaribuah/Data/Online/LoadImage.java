package com.abdulr.lestaribuah.Data.Online;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.widget.ImageView;

import com.abdulr.lestaribuah.R;

import java.io.IOException;
import java.io.InputStream;
import java.net.URL;

public class LoadImage extends AsyncTask<String, Void, Bitmap> {
    @SuppressLint("StaticFieldLeak")
    private ImageView img;
    @SuppressLint("StaticFieldLeak")
    private Activity activity;

    public LoadImage(ImageView img, Activity mActivity) {
        this.img = img;
        this.activity = mActivity;
    }

    @Override
    protected Bitmap doInBackground(String... urls) {
        String url = urls[0];
        Bitmap bm = null;

        try {
            try {
                InputStream is = new URL(url).openStream();
                bm = BitmapFactory.decodeStream(is);
            } catch (OutOfMemoryError e) {
                bm = BitmapFactory.decodeResource(activity.getResources(), R.drawable.no_image);
            }
        } catch (IOException e) {
            e.printStackTrace();
            bm = BitmapFactory.decodeResource(activity.getResources(), R.drawable.no_image);
        }
        return bm;
    }

    protected void onPostExecute(Bitmap bitmap) {
        img.setImageBitmap(bitmap);
    }
}
