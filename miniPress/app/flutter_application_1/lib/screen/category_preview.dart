import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../models/category.dart';
import '../providers/article_provider.dart';

class CategoryPreview extends StatefulWidget {
  final Category category;

  const CategoryPreview({super.key, required this.category});

  @override
  State<CategoryPreview> createState() => _CategoryPreviewState();
}

class _CategoryPreviewState extends State<CategoryPreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(widget.category.name, style: const TextStyle(fontSize: 16)),
      onTap: () {
        setState(() {
          Provider.of<ArticleProvider>(context, listen: false)
              .selectedArticlesUrl(widget.category.links['articles']['href']);
        });
      },
    );
  }
}
