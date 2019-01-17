import 'dart:async';
import 'dart:ui';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:toko_buah/data/api.dart';

class Login extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
      // TODO: implement createState
      return new LoginState();
    }
}

class LoginState extends State<Login> {
  BuildContext context;
  API api;

  bool isLoading = false;
  final formKey = new GlobalKey<FormState>();
  final scaffoldKey = new GlobalKey<ScaffoldState>();
  String email, password;

  void alert(String s) {
    scaffoldKey.currentState.showSnackBar(new SnackBar(content: new Text(s)));
  }

  @override
  Widget build(BuildContext context) {
    this.context = context;
    api = new API();

    var btnLogin = new MaterialButton(
      child: new Text("Masuk"),
      color: Colors.orange,
      textColor: Colors.white,
      onPressed: doLogin,
    );

    var formLogin = new Column(
      children: <Widget>[
        new Form(
          key: formKey,
          child: new Column(
            children: <Widget>[
              new Padding(
                padding: const EdgeInsets.all(8.0),
                child: new TextFormField(
                  onSaved: (val) => email = val,
                  validator: (val) {
                    return (val.toString().trim() == "") ? "E-mail tidak boleh kosong !" : null;
                  },
                  keyboardType: TextInputType.emailAddress,
                  decoration: new InputDecoration(
                    labelText: "E-mail",
                    icon: Icon(Icons.email)
                    ),
                )
              ),

              new Padding(
                padding: const EdgeInsets.all(8.0),
                child: new TextFormField(
                  onSaved: (val) => password = val,
                  obscureText: true,
                  validator: (val) {
                    return (val.toString().trim() == "") ? "Password tidak boleh kosong !" : null;
                  },
                  decoration: new InputDecoration(
                    labelText: "Password",
                    icon: Icon(Icons.lock)
                    ),
                )
              )
            ],
          ),
        ),
        (isLoading) ? new CircularProgressIndicator() : btnLogin,
      ],
      crossAxisAlignment: CrossAxisAlignment.center,
    );

    return new Scaffold(
      appBar: null,
      key: scaffoldKey,
      body: new Container(
        child: new Center(
          child: new ClipRect(
            child: new BackdropFilter(
              filter: new ImageFilter.blur(sigmaX: 10.0, sigmaY: 10.0),
              child: new Container(
                child: formLogin,
                height: 300.0,
                width: 300.0,
              ),
            ),
          ),
        ),
      ),
    );
  }

  void doLogin() {
    final form  = formKey.currentState;

    if(form.validate()) {
      form.save();

      Map<String, dynamic> body = {
        "email": email,
        "password": password
      };

      api.login(this, body);
    }
  }

  @override
  void onLoginError(String s) {
    alert(s);
    setState(() => isLoading = false);
  }

  @override 
  void onLoginSuccess(String s) {
    alert(s);
    setState(() => isLoading = false);
  }

  void loading(int code) {
    setState(() {
      switch (code) {
        case 0:
          isLoading = false;
          break;

        case 1:
          isLoading = true; 
          break;

        default:
          isLoading = false;
          break;
      }
    });
  }
}