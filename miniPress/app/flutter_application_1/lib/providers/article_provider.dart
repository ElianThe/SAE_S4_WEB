import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../models/Article.dart';

class ArticleProvider extends ChangeNotifier {
  String _selectedArticlesUrl = '/api/articles';

  Future<List<Article>> getArticleList() async {
    List<Article> listArticles = [];
    var url = Uri.parse('http://localhost:5380$_selectedArticlesUrl');
    var response = await http.Client().get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var articles = jsonData['articles'];

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

  void selectedArticlesUrl(String url) {
    if (url == _selectedArticlesUrl) return;
    _selectedArticlesUrl = url;
    notifyListeners();
  }
}
