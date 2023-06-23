import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/models/author.dart';
import 'package:http/http.dart' as http;

import '../models/category.dart';
import 'author_preview.dart';
import 'category_preview.dart';

class CategoryMaster extends StatefulWidget {
  CategoryMaster({super.key}) {
    getCategoryList();
    getAuthorList();
  }

  Future<List<Category>>? categoryList;

  Future<List<Category>> getCategoryList() async {
    List<Category> listCategories = [];
    var url = Uri.parse("http://docketu.iutnc.univ-lorraine.fr:22103/api/categories");
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

  Future<List<Author>>? authorList;

  Future<List<Author>> getAuthorList() async {
    List<Author> listAuthors = [];
    var url = Uri.parse("http://docketu.iutnc.univ-lorraine.fr:22103/api/auteurs");
    var response = await http.Client().get(url);
    if (response.statusCode == 200) {
      var jsonData = json.decode(response.body);
      var authors = jsonData['auteurs'];
      for (var authorObject in authors) {
        var author = authorObject['auteur'];
        listAuthors.add(Author(
            id: author['id'],
            email: author['email'],
            name: author['name'],
            links: authorObject['links']));
      }
    }
    authorList = Future<List<Author>>.value(listAuthors);
    return Future<List<Author>>.value(listAuthors);
  }

  @override
  State<CategoryMaster> createState() => _CategoryMasterState();
}

class _CategoryMasterState extends State<CategoryMaster> {
  @override
  Widget build(BuildContext context) {
    return Column(children: [
      const Text("Catégories d'articles",
          style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
      SingleChildScrollView(
          child: FutureBuilder(
              future: widget.categoryList ?? widget.getCategoryList(),
              builder: (BuildContext context, AsyncSnapshot snapshot) {
                if (snapshot.hasData) {
                  return ListView.builder(
                      shrinkWrap: true,
                      physics: const NeverScrollableScrollPhysics(),
                      itemCount: snapshot.data.length,
                      itemBuilder: (context, index) {
                        return CategoryPreview(category: snapshot.data[index]);
                      });
                } else {
                  return const Center(child: CircularProgressIndicator());
                }
              })),
      const Divider(),
      const Text('Auteurs',
          style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
      Expanded(
          child: FutureBuilder(
              future: widget.authorList ?? widget.getAuthorList(),
              builder: (BuildContext context, AsyncSnapshot snapshot) {
                if (snapshot.hasData) {
                  return ListView.builder(
                      itemCount: snapshot.data.length,
                      itemBuilder: (context, index) {
                        return AuthorPreview(author: snapshot.data[index]);
                      });
                } else {
                  return const Center(child: CircularProgressIndicator());
                }
              })),
    ]);
  }
}
