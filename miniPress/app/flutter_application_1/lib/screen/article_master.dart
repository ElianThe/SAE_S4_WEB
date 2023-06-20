import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/screen/article_details.dart';
import 'package:flutter_application_1/screen/article_preview.dart';
import 'package:flutter_application_1/models/Article.dart';
import 'package:http/http.dart' as http;

class ArticleMaster extends StatefulWidget {
  const ArticleMaster({super.key});

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();
}

class _ArticleMasterState extends State<ArticleMaster> {
  var client = http.Client();
  String baseUrl = "http://localhost:5380/api/";

  Future<List<Article>> getArticleList(String api) async {
    List<Article> listArticles = [];
    var url = Uri.parse(baseUrl + api);
    var response = await client.get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var articles = jsonData[api];

      // trier les articles par date de création inverse
      articles.sort((a, b) => DateTime.parse(b['article']['created_at'])
          .compareTo(DateTime.parse(a['article']['created_at'])));

      for (var articleObject in articles) {
        var article = articleObject['article'];
        listArticles.add(Article(
            title: article['title'],
            dateCrea: DateTime.parse(article['created_at']),
            auteur: article['user_id']));
      }
    }
    return Future<List<Article>>.value(listArticles);
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
        future: getArticleList('articles'),
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
                              builder: (context) => const ArticleDetails()));
                    },
                  );
                });
          } else {
            return const Center(child: CircularProgressIndicator());
          }
        });
  }
}
