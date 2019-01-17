import 'package:flutter/material.dart';
import 'package:toko_buah/views/pages/home.dart';
import 'package:toko_buah/views/login.dart';
import 'package:toko_buah/views/pages/splash_screen.dart';

final routes = {
  '/login': (BuildContext context) => new Login(),
  '/home':  (BuildContext context) => new Home(),
  '/' : (BuildContext context) => new SplashScreen(),
};