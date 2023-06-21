import 'package:flutter/material.dart';
import 'package:flutter_application_1/models/author.dart';
import 'package:provider/provider.dart';

import '../providers/article_provider.dart';

class AuthorPreview extends StatefulWidget {
  final Author author;

  const AuthorPreview({super.key, required this.author});

  @override
  State<AuthorPreview> createState() => _AuthorPreviewState();
}

class _AuthorPreviewState extends State<AuthorPreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(widget.author.name, style: const TextStyle(fontSize: 16)),
      onTap: () {
        setState(() {
          Provider.of<ArticleProvider>(context, listen: false)
              .selectedArticlesUrl(widget.author.links['articles']['href']);
        });
      },
    );
  }
}
