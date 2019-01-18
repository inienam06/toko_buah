import 'dart:async';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Session {
  String id_user = "id_user";
  String nama_user = "nama_user";
  String email_user = "email_user";
  String api_token = "api_token";
  String is_login = "is_login";

  //SETTER
  Future<bool> setId(int value) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.setInt(id_user, value);
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
  Future<int> getId() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    return session.getInt(id_user) ?? "";
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
  Future logout() async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    session.remove(id_user);
    session.remove(nama_user);
    session.remove(email_user);
    session.remove(api_token);
    session.remove(is_login);
  }

  //Login
  Future login(int id, String nama, String email, String apiToken) async {
    final SharedPreferences session = await SharedPreferences.getInstance();

    session.setInt(id_user, id);
    session.setString(nama_user, nama);
    session.setString(email_user, email);
    session.setString(api_token, apiToken);
    session.setBool(is_login, true);
  }
}