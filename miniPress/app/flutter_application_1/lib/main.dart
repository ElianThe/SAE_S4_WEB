import 'package:flutter/material.dart';
import 'package:flutter_application_1/minipress_app.dart';
import 'package:provider/provider.dart';

import 'providers/article_provider.dart';

void main() {
  runApp(ChangeNotifierProvider(
      create: (context) => ArticleProvider(), child: const MiniPressApp()));
}
