import 'package:flutter/material.dart';
import 'package:flutter_application_1/screen/article_details.dart';
import 'package:flutter_application_1/screen/article_preview.dart';
import 'package:flutter_application_1/screen/article_provider.dart';
import 'package:provider/provider.dart';

class ArticleMaster extends StatefulWidget {
  const ArticleMaster({super.key});

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();
}

/*
Future<List<Article>> _fetchArticles() {
  var faker = Faker();
  List<Article> listArticles = [];
  for (int i = 0; i < 100; i++) {
    Article article = Article(
        title: faker.lorem.word(),
        dateCrea: faker.date.dateTime(),
        auteur: faker.lorem.toString());
    listArticles.add(article);
  }
  ArticleProvider().getListArticles('articles');
  return Future<List<Article>>.value(listArticles);
}
*/

class _ArticleMasterState extends State<ArticleMaster> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Consumer<ArticleProvider>(
        builder: (context, articleProvider, child) {
          return FutureBuilder(
              future: articleProvider.getListArticles('articles'),
              builder: (BuildContext context, AsyncSnapshot snapshot) {
                if (snapshot.hasData) {
                  return ListView.builder(
                      itemCount: snapshot.data.length,
                      itemBuilder: (context, index) {
                        return InkWell(
                          child: ArticlePreview(article: snapshot.data[index]),
                          onTap: () {
                            Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) =>
                                        const ArticleDetails()));
                          },
                        );
                      });
                } else {
                  return const CircularProgressIndicator();
                }
              });
        },
      ),
    );
  }
}
