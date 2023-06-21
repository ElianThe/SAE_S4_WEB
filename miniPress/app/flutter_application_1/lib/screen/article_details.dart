import 'package:flutter/material.dart';
import 'package:flutter_markdown/flutter_markdown.dart';

import '../models/article.dart';

class ArticleDetails extends StatefulWidget {
  final Article article;

  const ArticleDetails({super.key, required this.article});

  @override
  State<ArticleDetails> createState() => _ArticleDetailsState();
}

class _ArticleDetailsState extends State<ArticleDetails> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Détails de l\'article'),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              widget.article.title,
              style: const TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10.0),
            Text(
              'Résumé : ${widget.article.summary}',
              style: const TextStyle(
                fontSize: 18,
              ),
            ),
            const SizedBox(height: 16.0),
            Row(children: [
              Icon(Icons.person, size: 18.0, color: Colors.grey[600]),
              const SizedBox(width: 6.0),
              Text(
                'Auteur : ${widget.article.author}',
                style: const TextStyle(
                  fontSize: 18,
                ),
              )
            ]),
            const SizedBox(height: 16.0),
            Row(children: [
              Icon(Icons.calendar_today, size: 18.0, color: Colors.grey[600]),
              const SizedBox(width: 6.0),
              Text(
                'Date de création : ${widget.article.createdAt.day.toString().padLeft(2, '0')}/${widget.article.createdAt.month.toString().padLeft(2, '0')}/${widget.article.createdAt.year} ${widget.article.createdAt.hour.toString()}:${widget.article.createdAt.minute.toString().padLeft(2, '0')}',
                style: const TextStyle(
                  fontSize: 18,
                ),
              ),
            ]),
            const SizedBox(height: 20.0),
            const Center(
                child: Text(
              'Contenu :',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
              ),
            )),
            const Divider(),
            MarkdownBody(data: widget.article.content),
            const Divider(),
          ],
        ),
      ),
    );
  }
}
