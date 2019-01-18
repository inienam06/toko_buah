import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:toko_buah/views/login.dart';
import 'package:toko_buah/data/system.dart';
import 'package:toko_buah/data/session.dart';

class API {
  final String base_url = 'http://192.168.43.29/project/toko_buah/web/api/';
  final String apikey = '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==';
  System system;
  Session session;

  API() {
    system = new System();  
    session = new Session();
  }

  Future login (LoginState activity, Map<String, dynamic> body) async {
    var url = base_url+"user/masuk";

    activity.onLogin();

    print("Body: " + body.toString());

    http.post(url,
        headers: {
          "Content-Type": "application/json",
          "apikey": apikey
          },
        body: json.encode(body)
    ).then((http.Response response) {
      Map<String, dynamic> res = jsonDecode(response.body);
      Map<String, dynamic> data = res['data'];

      print(data);

      if(res['status'] == true && res['code'] == 200) {
        activity.onLoginSuccess('Login Sukses');
        system.updateToken(this, data['id_user'], data['api_token']);

        session.login(data['id_user'], data['nama_lengkap'], data['email'], data['api_token']);
      } else {
        activity.alert(res['message']);
      }

      // activity.alert(res['message']);
    });

    activity.loading(0);
  }

  Future<http.Response> updateFirebase (Map<String, dynamic> body) async {
    var url = base_url+"update-firebase";

    print("Body: " + body.toString());

    http.post(url,
        headers: {
          "Content-Type": "application/json",
          "apikey": apikey,
          "Authorization": "Bearer "+body['api_token']
          },
        body: json.encode(body)
    ).then((http.Response response) {
      Map<String, dynamic> res = jsonDecode(response.body);

      print(res);
    });
  }
}