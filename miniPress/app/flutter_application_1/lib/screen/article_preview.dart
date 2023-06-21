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
      trailing: Row(mainAxisSize: MainAxisSize.min, children: [
        Text(
            "${widget.article.createdAt.day.toString().padLeft(2, '0')}/${widget.article.createdAt.month.toString().padLeft(2, '0')}/${widget.article.createdAt.year} ${widget.article.createdAt.hour.toString()}:${widget.article.createdAt.minute.toString().padLeft(2, '0')}"),
        const SizedBox(width: 10),
        widget.article.isPublished
            ? const Icon(Icons.check_box)
            : const Icon(Icons.check_box_outline_blank)
      ]),
    );
  }
}
