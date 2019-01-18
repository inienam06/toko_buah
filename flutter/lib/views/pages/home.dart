import 'package:flutter/material.dart';
import 'package:toko_buah/data/session.dart';
import 'package:toko_buah/data/system.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
      // TODO: implement createState
      return new HomeState();
    }
}

class HomeState extends State<Home> {
  System system;
  Session session;
  String nama = "";

  @override
  Widget build(BuildContext context) {
    onReady();
    return Scaffold(
      appBar: AppBar(
        title: Text('Home'),
        textTheme: TextTheme(
            title: TextStyle(
            color: Colors.white
          )
        ),
        iconTheme: new IconThemeData(color: Colors.white)
      ),
      body: Center(child: Text('Content!')),
      drawer: Drawer(
        // Add a ListView to the drawer. This ensures the user can scroll
        // through the options in the Drawer if there isn't enough vertical
        // space to fit everything.
        child: ListView(
          // Important: Remove any padding from the ListView.
          padding: EdgeInsets.zero,
          children: <Widget>[
            DrawerHeader(
              child: new Text(nama),
              decoration: BoxDecoration(
                color: Colors.orange,
              ),
            ),
            ListTile(
              title: new Text('Item 1'),
              onTap: () {
                // Update the state of the app
                // ...
                // Then close the drawer
                Navigator.pop(context);
              },
            ),
            ListTile(
              title: Text('Logout'),
              onTap: () {
                session.logout();
                system.nextPage(context, '/login');
                system.alert(context, 'Anda Telah Logout');
              },
            ),
          ],
        ),
      ),
    );
  }

  void onReady() {
    system = new System();
    session = new Session();

    session.getNama().then((value) {
      print(value);
      nama = value;
    });
  }
}