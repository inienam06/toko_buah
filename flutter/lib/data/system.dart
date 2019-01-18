import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:path/path.dart';
import 'package:toko_buah/data/api.dart';

class System {
  FirebaseMessaging messaging;

  System() {
    messaging = new FirebaseMessaging();

    initFirebase();
  }

  void initFirebase() {
    messaging.configure(
      onMessage: (Map<String, dynamic> message) {
        print('on message $message');
      },
      onResume: (Map<String, dynamic> message) {
        print('on resume $message');
      },
      onLaunch: (Map<String, dynamic> message) {
        print('on launch $message');
      },
    );
  }

  void requestNotifFirebase() {
    messaging.requestNotificationPermissions(
        const IosNotificationSettings(sound: true, badge: true, alert: true));
  }

  void updateToken(API api, int id, String api_token) {
    messaging.getToken().then((token) {
      Map<String, dynamic> body = {"token": token, "id_user": id, "api_token": api_token};

      api.updateFirebase(body);
    });
  }

  void nextPage(BuildContext context, String page) {
    Navigator.of(context).pushReplacementNamed(page);
  }

  void alert(BuildContext context, String value) {
    final scaffoldKey = new GlobalKey<ScaffoldState>();
    scaffoldKey.currentState.showSnackBar(
      new SnackBar(
        content: new Text(value)
      )
    );
  }
}