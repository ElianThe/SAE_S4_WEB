import 'package:flutter/material.dart';
import 'package:flutter_application_1/screen/article_preview.dart';
import 'package:provider/provider.dart';

import '../providers/article_provider.dart';

class ArticleMaster extends StatefulWidget {
  const ArticleMaster({super.key});

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();
}

class _ArticleMasterState extends State<ArticleMaster> {
  @override
  Widget build(BuildContext context) {
    return Consumer<ArticleProvider>(
      builder: (context, articleProvider, child) {
        return FutureBuilder(
          future: articleProvider.getArticleList(),
          builder: (BuildContext context, AsyncSnapshot snapshot) {
            if (snapshot.hasData &&
                snapshot.connectionState != ConnectionState.waiting) {
              return ListView.builder(
                itemCount: snapshot.data!.length,
                itemBuilder: (context, index) {
                  return Card(
                    child: ArticlePreview(article: snapshot.data![index]),
                  );
                },
              );
            } else {
              return const Center(child: CircularProgressIndicator());
            }
          },
        );
      },
    );
  }
}
