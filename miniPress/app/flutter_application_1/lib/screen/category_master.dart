import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';

import '../models/Category.dart';
import '../providers/article_provider.dart';
import 'category_preview.dart';

class CategoryMaster extends StatefulWidget {
  CategoryMaster({super.key});

  Future<List<Category>>? categoryList;

  @override
  State<CategoryMaster> createState() => _CategoryMasterState();
}

class _CategoryMasterState extends State<CategoryMaster> {
  var client = http.Client();
  String baseUrl = "http://localhost:5380";

  Future<List<Category>> getCategoryList(String api) async {
    List<Category> listCategories = [];
    var url = Uri.parse(baseUrl + api);
    var response = await client.get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var categories = jsonData['categories'];
      for (var categoryObject in categories) {
        var category = categoryObject['category'];
        listCategories.add(Category(
            id: category['id'],
            name: category['name'],
            links: categoryObject['links']));
      }
    }
    widget.categoryList = Future<List<Category>>.value(listCategories);
    return Future<List<Category>>.value(listCategories);
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
        future: widget.categoryList ?? getCategoryList('/api/categories'),
        builder: (BuildContext context, AsyncSnapshot snapshot) {
          if (snapshot.hasData) {
            return ListView.builder(
                itemCount: snapshot.data.length,
                itemBuilder: (context, index) {
                  return InkWell(
                    child: CategoryPreview(category: snapshot.data[index]),
                    onTap: () {
                      setState(() {
                        Provider.of<ArticleProvider>(context, listen: false)
                            .selectedArticlesUrl(
                                snapshot.data[index].links['articles']['href']);
                      });
                    },
                  );
                });
          } else {
            return const Center(child: CircularProgressIndicator());
          }
        });
  }
}
