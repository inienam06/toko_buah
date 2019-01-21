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
  String email = "";
  int selectedIndex = 0;
  final widgetOptions = [
    home(),
    Text('Pesanan'),
    Text('profil'),
  ];
  Icon searchIcon = new Icon(Icons.search);
  Widget titleAppBar = new Text('Home');
  final TextEditingController searchForm = new TextEditingController();

  @override
  Widget build(BuildContext context) {
    onReady();
    return Scaffold(
      appBar: AppBar(
        title: titleAppBar,
        textTheme: TextTheme(
            title: TextStyle(
            color: Colors.white
          )
        ),
        iconTheme: new IconThemeData(color: Colors.white),
        actions: <Widget>[
          new IconButton(
            icon: searchIcon,
            onPressed: search,
          )
        ],
      ),
      body: Center(
        child: widgetOptions.elementAt(selectedIndex)
        ),
      bottomNavigationBar: BottomNavigationBar(
       items: <BottomNavigationBarItem>[
         BottomNavigationBarItem(icon: Icon(Icons.home), title: Text('Beranda')),
         BottomNavigationBarItem(icon: Icon(Icons.note), title: Text('Pesanan')),
         BottomNavigationBarItem(icon: Icon(Icons.account_circle), title: Text('Profil')),
       ],
       currentIndex: selectedIndex,
       fixedColor: Colors.orange,
       onTap: onItemTapped,
      ),
      drawer: Drawer(
        // Add a ListView to the drawer. This ensures the user can scroll
        // through the options in the Drawer if there isn't enough vertical
        // space to fit everything.
        child: ListView(
          // Important: Remove any padding from the ListView.
          padding: EdgeInsets.zero,
          children: <Widget>[
            UserAccountsDrawerHeader(
              accountName: Text(nama),
              accountEmail: Text(email),
              currentAccountPicture: CircleAvatar(
                backgroundColor:
                    Theme.of(context).platform == TargetPlatform.iOS
                        ? Colors.blue
                        : Colors.white,
                child: Text(
                  nama.substring(0,1).toUpperCase(),
                  style: TextStyle(fontSize: 40.0),
                ),
              ),
            ),
            ListTile(
              title: new Text('Pesanan Anda'),
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
      setState(() {
        nama = value;
      });
    });

    session.getEmail().then((value) {
      setState(() {
        email = value;
      });
    });
  }

  void onItemTapped(int index) {
    setState(() {
      selectedIndex = index;
    });
  }

  static Widget home() {
    return Text('Home');
  }

  void search() {
    setState(() {
      if (this.searchIcon.icon == Icons.search) {
        this.searchIcon = new Icon(Icons.close);
        this.titleAppBar = new TextField(
          controller: searchForm,
          decoration: new InputDecoration(
            hintText: 'Cari Buah...',
            hintStyle: TextStyle(color: Colors.white),
            labelStyle: TextStyle(color: Colors.white),
            enabledBorder: new UnderlineInputBorder(
              borderSide: BorderSide(color: Colors.white),
            ),
            focusedBorder: new UnderlineInputBorder(
              borderSide: BorderSide(color: Colors.white),
            )
          ),
          style: TextStyle(color: Colors.white),
        );
      } else {
        this.searchIcon = new Icon(Icons.search);
        this.titleAppBar = new Text('Home');
        searchForm.clear();
      }
    });
  }
}