import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/models/Article.dart';
import 'package:http/http.dart' as http;

class ArticleProvider extends ChangeNotifier {
  var client = http.Client();
  String baseUrl = "http://localhost:5380/api/";

  Future<List<Article>> getListArticles(String api) async {
    List<Article> listArticles = [];
    var url = Uri.parse(baseUrl + api);
    var response = await client.get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var articles = jsonData[api];
      for (var article in articles) {
        var larticle = Article(
            title: article['titre'],
            dateCrea: DateTime.parse(article['date_creation']),
            auteur: article['user_id']);
        listArticles.add(larticle);
      }
    }
    return Future<List<Article>>.value(listArticles);
  }
}
