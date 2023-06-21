import 'package:flutter/material.dart';
import 'package:flutter_application_1/models/article.dart';

import 'article_details.dart';

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
      subtitle: Text("Auteur :  ${widget.article.author}"),
      trailing: Text(
          "${widget.article.createdAt.day.toString().padLeft(2, '0')}/${widget.article.createdAt.month.toString().padLeft(2, '0')}/${widget.article.createdAt.year} ${widget.article.createdAt.hour.toString()}:${widget.article.createdAt.minute.toString().padLeft(2, '0')}"),
      onTap: () {
        Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) => ArticleDetails(article: widget.article)));
      },
    );
  }
}
