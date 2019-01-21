import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:toko_buah/route.dart';

void main() => runApp(new MainApp());

class MainApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle.light);
    return new MaterialApp(
        title: 'Toko Buah',
        theme: new ThemeData(
          primaryColor: Colors.orange,
        ),
        routes: routes,
    );
  }
}
