import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../models/article.dart';

class ArticleProvider extends ChangeNotifier {
  String _selectedArticlesUrl = '/api/articles';
  bool isAscending = false;
  bool _sorted = false;
  List<Article> _articles = [];

  Future<List<Article>> getArticleList() async {
    if (_sorted) {
      _sorted = false;
      _articles.sort((a, b) => isAscending
        ? a.createdAt.compareTo(b.createdAt)
        : b.createdAt.compareTo(a.createdAt));
      return Future<List<Article>>.value(_articles);
    }

    List<Article> listArticles = [];
    var url = Uri.parse('http://localhost:5380$_selectedArticlesUrl');
    var response = await http.Client().get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var articles = jsonData['articles'];

      // trier les articles par date de création décroissante
      articles.sort((a, b) => DateTime.parse(b['article']['created_at'])
          .compareTo(DateTime.parse(a['article']['created_at'])));

      for (var articleObject in articles) {
        var article = articleObject['article'];
        listArticles.add(Article(
            title: article['title'],
            summary: article['summary'],
            content: article['content'],
            createdAt: DateTime.parse(article['created_at']),
            author: article['user']['name'],
        ));
      }
    }
    _articles = listArticles;
    return Future<List<Article>>.value(listArticles);
  }

  void selectedArticlesUrl(String url) {
    if (url == _selectedArticlesUrl) return;
    _selectedArticlesUrl = url;
    notifyListeners();
  }

  void toggleSortOrder(cb) {
    if (_articles.isEmpty) return;
    isAscending = !isAscending;
    _sorted = true;
    notifyListeners();
    cb();
  }
}
