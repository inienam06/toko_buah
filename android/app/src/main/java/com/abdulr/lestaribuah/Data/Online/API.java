package com.abdulr.lestaribuah.Data.Online;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.util.Log;
import android.widget.Toast;

import com.abdulr.lestaribuah.Fragment.ArrivedTabFragment;
import com.abdulr.lestaribuah.Fragment.HistoryFragment;
import com.abdulr.lestaribuah.Fragment.HomeFragment;
import com.abdulr.lestaribuah.Fragment.InOrderTabFragment;
import com.abdulr.lestaribuah.Fragment.WaitingTabFragment;
import com.abdulr.lestaribuah.R;
import com.abdulr.lestaribuah.Views.Home.MainActivity;
import com.abdulr.lestaribuah.Views.LoginRegister.LoginActivity;
import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class API {
    private static final String base_url = "http://192.168.43.29/project/toko_buah/web/";
    private static final String base_url_api = base_url + "api/";
    private static final String apikey = "3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==";
    private static final String server_key_firebase = "AAAAMPn6pVs:APA91bFMR8J6mwCKy3wuTSJkbEuH7Pp0eLJAsJvEvdm1Wd-zhhhHcIZsBluVuAYqbv7HCXxQT7jMBlVYwmeltq6yOXenBBIbmyNVS_LqXNWmklr4BJqOAWBeEOBu0Ps7GDK8bmNKsnxP";
    private static RequestQueue queue;

    //GLOBAL
    public String getBaseUrl() {
        return base_url;
    }

    public void sending_notif(Activity activity, final String title, final String body) {
        final String url = "https://fcm.googleapis.com/fcm/send";
        queue = Volley.newRequestQueue(activity);
        final JSONObject pos = new JSONObject();
        final JSONObject data = new JSONObject();
        final String auth = "key="+server_key_firebase;


        FirebaseInstanceId.getInstance().getInstanceId().addOnSuccessListener(activity, new OnSuccessListener<InstanceIdResult>() {
            @Override
            public void onSuccess(InstanceIdResult instanceIdResult) {
                try {
                    data.put("title", title);
                    data.put("body", body);

                    pos.put("to", instanceIdResult.getToken());
                    pos.put("notification", data);

                    Log.d("param", pos.toString());

                    JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.POST, url, pos, new Response.Listener<JSONObject>() {
                        @Override
                        public void onResponse(JSONObject response) {
                            Log.d("Response", String.valueOf(response));
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Log.e("error notif", error.toString());
                        }
                    }) {
                        @Override
                        public Map<String, String> getHeaders() throws AuthFailureError {
                            Map headers = new HashMap();
                            headers.put("Authorization", auth);
                            headers.put("Content-Type", "application/json");
                            return headers;
                        }
                    };
                    jsonObjectRequest.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

                    queue.add(jsonObjectRequest);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }
    //ENDGLOBAL

    //ACCOUNT
    public void login(final LoginActivity activity, final JSONObject obj) {
        String url = base_url_api + "user/masuk";
        queue = Volley.newRequestQueue(activity);

        activity.config.loading(1);

        Log.d("param login", obj.toString());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.POST, url, obj, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response login", response.toString());
                JSONObject param = new JSONObject();

                try {
                    if(response.getInt("code") == 200) {
                        JSONObject data = response.getJSONObject("data");

                        int id = data.getInt("id_user");
                        String nama = data.getString("nama_lengkap");
                        String email = data.getString("email");
                        String noHp = data.getString("no_handphone");
                        String token = data.getString("api_token");
                        String tokenFirebase = data.getString("token_firebase");

                        activity.session.login(id, nama, email, noHp, token, tokenFirebase);

                        activity.startActivity(activity.config.goIntent(MainActivity.class,0,null,null));
                    } else {
                        Toast.makeText(activity, response.getString("message"), Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    Toast.makeText(activity, activity.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();
                }

                activity.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error firebase", error.toString());

                Toast.makeText(activity, activity.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();
                activity.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();
                headers.put("apikey", apikey);
                headers.put("Content-Type", "application/json");
                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }

    public void update_firebase(final MainActivity activity, final JSONObject obj) {
        String url = base_url_api + "update-firebase";
        queue = Volley.newRequestQueue(activity);

        Log.d("param firebase", obj.toString());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.POST, url, obj, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response firebase", response.toString());

                try {
                    activity.session.setTokenFirebase(obj.getString("token"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error firebase", error.toString());

                Toast.makeText(activity, activity.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();
                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + activity.session.getToken());
                headers.put("Content-Type", "application/json");
                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }
    //ENDACCOUNT

    //MAIN
    public void getBeranda(final HomeFragment fragment) {
        fragment.config.loading(1);
        String url = base_url_api + "beranda";
        queue = Volley.newRequestQueue(fragment.getActivity());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response beranda", response.toString());

                try {
                    if(response.getInt("code") != 200) {
                        Toast.makeText(fragment.getActivity(), response.getString("message"), Toast.LENGTH_SHORT).show();
                    } else {
                        JSONArray terpopuler = response.getJSONObject("data").getJSONArray("terpopuler");
                        JSONArray terbaru = response.getJSONObject("data").getJSONArray("terbaru");

                        fragment.setBeranda(terpopuler, terbaru);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                fragment.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error beranda", error.toString());

                Toast.makeText(fragment.getActivity(), fragment.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();

                fragment.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();

                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + fragment.session.getToken());
                headers.put("Content-Type", "application/json");

                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }

    public void getOrderStatusWaiting(final WaitingTabFragment fragment) {
        fragment.config.loading(1);

        String url = base_url_api + "pesanan/0/" + fragment.session.getId();
        queue = Volley.newRequestQueue(fragment.getActivity());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @SuppressLint("LongLogTag")
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response get status waiting", response.toString());

                try {
                    if(response.getInt("code") != 200) {
                        fragment.isEmpty();
                    } else {
                        fragment.isExists();
                        fragment.putData(response.getJSONArray("data"));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                fragment.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @SuppressLint("LongLogTag")
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error get status waiting", error.toString());

                Toast.makeText(fragment.getActivity(), fragment.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();

                fragment.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();

                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + fragment.session.getToken());
                headers.put("Content-Type", "application/json");

                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }

    public void getOrderStatusInOrder(final InOrderTabFragment fragment) {
        fragment.config.loading(1);

        String url = base_url_api + "pesanan/1/" + fragment.session.getId();
        queue = Volley.newRequestQueue(fragment.getActivity());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @SuppressLint("LongLogTag")
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response get order status in order", response.toString());

                try {
                    if(response.getInt("code") != 200) {
                        fragment.isEmpty();
                    } else {
                        fragment.isExists();
                        fragment.putData(response.getJSONArray("data"));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                fragment.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @SuppressLint("LongLogTag")
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error get order status in order", error.toString());

                Toast.makeText(fragment.getActivity(), fragment.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();

                fragment.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();

                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + fragment.session.getToken());
                headers.put("Content-Type", "application/json");

                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }

    public void getOrderStatusArrived(final ArrivedTabFragment fragment) {
        fragment.config.loading(1);

        String url = base_url_api + "pesanan/2/" + fragment.session.getId();
        queue = Volley.newRequestQueue(fragment.getActivity());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @SuppressLint("LongLogTag")
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response get order status arrived", response.toString());

                try {
                    if(response.getInt("code") != 200) {
                        fragment.isEmpty();
                    } else {
                        fragment.isExists();
                        fragment.putData(response.getJSONArray("data"));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                fragment.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @SuppressLint("LongLogTag")
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error get order status arrived", error.toString());

                Toast.makeText(fragment.getActivity(), fragment.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();

                fragment.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();

                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + fragment.session.getToken());
                headers.put("Content-Type", "application/json");

                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }

    public void getHistory(final HistoryFragment fragment) {
        fragment.config.loading(1);

        String url = base_url_api + "pesanan/3/" + fragment.session.getId();
        queue = Volley.newRequestQueue(fragment.getActivity());

        JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @SuppressLint("LongLogTag")
            @Override
            public void onResponse(JSONObject response) {
                Log.d("response history", response.toString());

                try {
                    if(response.getInt("code") != 200) {
                        Toast.makeText(fragment.getActivity(), "Riwayat pesanan tidak ditemukan !", Toast.LENGTH_SHORT).show();
                        fragment.isEmpty();
                    } else {
                        fragment.isExists();
                        fragment.putData(response.getJSONArray("data"));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                fragment.config.loading(0);
            }
        }, new Response.ErrorListener() {
            @SuppressLint("LongLogTag")
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("error get history", error.toString());

                Toast.makeText(fragment.getActivity(), fragment.getString(R.string.server_problem), Toast.LENGTH_SHORT).show();

                fragment.config.loading(0);
            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map headers = new HashMap();

                headers.put("apikey", apikey);
                headers.put("Authorization", "Bearer " + fragment.session.getToken());
                headers.put("Content-Type", "application/json");

                return headers;
            }
        };

        req.setRetryPolicy(new DefaultRetryPolicy(60000, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        queue.add(req);
    }
    //ENDMAIN
}
