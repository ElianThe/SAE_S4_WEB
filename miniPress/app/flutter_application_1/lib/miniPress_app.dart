import 'package:flutter/material.dart';
import 'package:flutter_application_1/screen/article_master.dart';
import 'package:flutter_application_1/screen/category_master.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        title: 'MiniPress-App',
        home: Scaffold(
            appBar: AppBar(
              title: const Center(child: Text('Accueil')),
            ),
            body: const ArticleMaster(),
            drawer: const Drawer(
                child: Column(
              children: [
                SizedBox(
                  height: 100.0,
                  child: DrawerHeader(
                    decoration: BoxDecoration(
                      color: Colors.blue,
                    ),
                    child: Center(
                      child: Column(
                        children: [
                          Text(
                            'MiniPress',
                            style: TextStyle(
                              fontSize: 24,
                              color: Colors.white,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          Padding(padding: EdgeInsets.only(bottom: 10)),
                          Text(
                            'Catégories',
                            style: TextStyle(
                              fontSize: 18,
                              color: Colors.white,
                              decoration: TextDecoration.underline,
                              height: 1.5,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                Expanded(
                  child: CategoryMaster(),
                ),
              ],
            ))));
  }
}
