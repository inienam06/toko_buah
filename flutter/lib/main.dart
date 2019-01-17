import 'package:flutter/material.dart';
import 'package:toko_buah/route.dart';

void main() => runApp(new MainApp());

class MainApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return new MaterialApp(
        title: 'Startup Name Generator',
        theme: new ThemeData(
          primaryColor: Colors.orange,
        ),
        routes: routes,
    );
  }
}
