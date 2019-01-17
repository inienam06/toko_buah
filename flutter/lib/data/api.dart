import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:toko_buah/views/login.dart';
import 'package:toko_buah/data/system.dart';

class API {
  final String base_url = 'http://192.168.43.29/project/toko_buah/api/';
  final String apikey = '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==';
  System system;

  API() {
    system = new System();  
  }

  Future<http.Response> login (LoginState activity, Map<String, dynamic> body) async {
    var url = base_url+"user/masuk";

    activity.loading(1);

    print("Body: " + body.toString());

    http.post(url,
        headers: {
          "Content-Type": "application/json",
          "apikey": apikey
          },
        body: json.encode(body)
    ).then((http.Response response) {
      Map<String, dynamic> res = jsonDecode(response.body);

      print(res);

      if(res['status'] == true && res['code'] == 200) {
        system.updateToken(this, res['data']['id_user'], res['data']['api_token']);
      }

      activity.alert(res['message']);
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