import 'package:flutter/material.dart';

import '../models/category.dart';

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
    );
  }
}
