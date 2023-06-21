import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';

import '../models/category.dart';
import '../providers/article_provider.dart';
import 'category_preview.dart';

class CategoryMaster extends StatefulWidget {
  CategoryMaster({super.key}) {
    getCategoryList();
  }

  Future<List<Category>>? categoryList;

  Future<List<Category>> getCategoryList() async {
    List<Category> listCategories = [];
    var url = Uri.parse("http://localhost:5380/api/categories");
    var response = await http.Client().get(url);
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
    categoryList = Future<List<Category>>.value(listCategories);
    return Future<List<Category>>.value(listCategories);
  }

  @override
  State<CategoryMaster> createState() => _CategoryMasterState();
}

class _CategoryMasterState extends State<CategoryMaster> {
  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
        future: widget.categoryList ?? widget.getCategoryList(),
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
