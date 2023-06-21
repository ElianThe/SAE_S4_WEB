import 'package:flutter/material.dart';
import 'package:flutter_application_1/providers/article_provider.dart';
import 'package:flutter_application_1/screen/article_master.dart';
import 'package:flutter_application_1/screen/category_master.dart';
import 'package:provider/provider.dart';

import 'screen/filter_text_field.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    IconData currentIcon =
        Provider.of<ArticleProvider>(context, listen: false).isAscending
            ? Icons.keyboard_arrow_up
            : Icons.keyboard_arrow_down;
    return MaterialApp(
        title: 'MiniPress-App',
        home: Scaffold(
            appBar: AppBar(
                title: const Center(child: Text('Accueil')),
                actions: const [FilterTextField()]),
            body: const ArticleMaster(),
            drawer: Drawer(
                child: Column(
              children: [
                const SizedBox(
                  height: 70.0,
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
                        ],
                      ),
                    ),
                  ),
                ),
                Expanded(
                  child: CategoryMaster(),
                ),
              ],
            )),
            floatingActionButton: Builder(
              builder: (BuildContext context) {
                return FloatingActionButton(
                  onPressed: () {
                    setState(() {
                      Provider.of<ArticleProvider>(context, listen: false)
                          .toggleSortOrder(() => {
                                ScaffoldMessenger.of(context)
                                    .hideCurrentSnackBar(),
                                ScaffoldMessenger.of(context)
                                    .showSnackBar(SnackBar(
                                  content: Text(Provider.of<ArticleProvider>(
                                              context,
                                              listen: false)
                                          .isAscending
                                      ? 'Articles triés par ordre croissant de date de création'
                                      : 'Articles triés par ordre décroissant de date de création'),
                                  duration: const Duration(seconds: 2),
                                ))
                              });
                    });
                  },
                  backgroundColor: Colors.blue,
                  child: Icon(currentIcon),
                );
              },
            )));
  }
}
