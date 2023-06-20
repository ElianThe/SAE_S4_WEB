import 'package:flutter/material.dart';
import 'package:flutter_application_1/models/Article.dart';

class ArticlePreview extends StatefulWidget {
  final Article article;

  const ArticlePreview({super.key, required this.article});

  @override
  State<ArticlePreview> createState() => _ArticlePreviewState();
}

class _ArticlePreviewState extends State<ArticlePreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(widget.article.title),
      subtitle: Text("user id :  ${widget.article.auteur}"),
      trailing: Text(
          "${widget.article.dateCrea.day}/${widget.article.dateCrea.month}/${widget.article.dateCrea.year} ${widget.article.dateCrea.hour}:${widget.article.dateCrea.minute}"),
    );
  }
}
