import 'package:flutter/material.dart';
import 'package:flutter_application_1/screen/article_master.dart';
import 'package:flutter_application_1/screen/article_provider.dart';
import 'package:provider/provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => ArticleProvider(),
      child: MaterialApp(
          title: 'MiniPress-App',
          home: Scaffold(
            appBar: AppBar(
              title: const Text('Accueil'),
            ),
            body: const ArticleMaster(),
          )),
    );
  }
}
