import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

import 'package:toko_buah/data/session.dart';

class SplashScreen extends StatefulWidget {
  @override
  initState createState() => initState();
}
  
class initState extends State<SplashScreen> {
  Session session;
  
  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    initSplash(context);

    return new Scaffold(
      body: new Center(
        child: new CircularProgressIndicator(),
      )
    );
  }

  void initSplash(BuildContext ctx) {
    session = new Session();

    session.getIsLogin().then((bool value){
      Timer(Duration(milliseconds: 2000), (){
        if(value) {
          nextPage("/home");
        } else {
          nextPage("/login");
        }
      });
      
    });
  }

  void nextPage(String page) {
    Navigator.of(context).pushReplacementNamed(page);
  }
}