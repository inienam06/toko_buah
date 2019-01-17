import 'dart:async';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Session {
  BuildContext context;

  String id_user = "id_user";
  String nama_user = "nama_user";
  String email_user = "email_user";
  String api_token = "api_token";
  String is_login = "is_login";

  Session(BuildContext context) {
    this.context = context;
  }

  //SETTER
  Future<bool> setId(String value) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setString(id_user, value);
  }

  Future<bool> setNama(String value) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setString(nama_user, value);
  }

  Future<bool> email(String value) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setString(email_user, value);
  }

  Future<bool> token(String value) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setString(api_token, value);
  }

  Future<bool> setIsLogin(bool login) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setBool(is_login, login);
  }

  //GETTER
  Future<String> getId() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getString(id_user) ?? "";
  }

  Future<String> getNama() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getString(nama_user) ?? "";
  }

  Future<String> getEmail() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getString(email_user) ?? "";
  }

  Future<String> getToken() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getString(api_token) ?? "";
  }

  Future<bool> getIsLogin() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getBool(is_login) ?? false;
  }

  //REMOVER
  Future removeAll() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    session.remove(nama_user);
    session.remove(is_login);
  }
}